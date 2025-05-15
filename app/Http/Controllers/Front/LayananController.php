<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Kategori;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        // Get the type from request
        $type = $request->input('type');

        // Initialize queries with relationships
        $layananQuery = Layanan::with('kategori');
        $paketQuery = PaketLayanan::with(['kategori', 'layanans']);

        // Apply category filter
        if ($request->filled('category')) {
            $layananQuery->where('kategori_id', $request->category);
            $paketQuery->where('kategori_id', $request->category);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $layananQuery->where(function($q) use ($search) {
                $q->where('nama_layanan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
            
            $paketQuery->where(function($q) use ($search) {
                $q->where('nama_paket', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortField = 'created_at';
        $sortDirection = 'desc';
        
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price-low':
                    $sortField = $type === 'paket' ? 'harga_paket' : 'harga_layanan';
                    $sortDirection = 'asc';
                    break;
                case 'price-high':
                    $sortField = $type === 'paket' ? 'harga_paket' : 'harga_layanan';
                    $sortDirection = 'desc';
                    break;
                case 'newest':
                    $sortField = 'created_at';
                    $sortDirection = 'desc';
                    break;
                case 'popular':
                    $sortField = 'created_at';
                    $sortDirection = 'desc';
                    break;
            }
        }

        // Get results based on type
        if ($type === 'paket') {
            $results = $paketQuery->orderBy($sortField, $sortDirection)->get();
            $results->each(function ($item) {
                $item->type = 'paket';
            });
        } elseif ($type === 'layanan') {
            $results = $layananQuery->orderBy($sortField, $sortDirection)->get();
            $results->each(function ($item) {
                $item->type = 'layanan';
            });
        } else {
            // Get both types
            $layananResults = $layananQuery->orderBy($sortField, $sortDirection)->get();
            $paketResults = $paketQuery->orderBy($sortField, $sortDirection)->get();
            
            $layananResults->each(function ($item) {
                $item->type = 'layanan';
            });
            
            $paketResults->each(function ($item) {
                $item->type = 'paket';
            });

            $results = $layananResults->concat($paketResults)->sortByDesc('created_at');
        }

        // Debug: Log the results before pagination
        Log::info('Results before pagination:', [
            'type' => $type,
            'total_results' => $results->count(),
            'sample_items' => $results->take(2)->toArray()
        ]);

        // Paginate results
        $page = $request->input('page', 1);
        $perPage = 9;
        $offset = ($page - 1) * $perPage;
        
        $layanans = new \Illuminate\Pagination\LengthAwarePaginator(
            $results->slice($offset, $perPage),
            $results->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $kategoris = Kategori::all();
        return view('front.layanan', compact('layanans', 'kategoris'));
    }
} 