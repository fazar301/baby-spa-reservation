<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class LayananApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Start with base queries for both models
            $layananQuery = Layanan::with(['kategori']);
            $paketQuery = PaketLayanan::with(['kategori', 'layanans']);

            // Filter by category if specified
            if ($request->filled('kategori')) {
                $layananQuery->where('kategori_id', $request->kategori);
                $paketQuery->where('kategori_id', $request->kategori);
            }

            // Search functionality
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

            // Get the results based on type filter
            if ($request->filled('type')) {
                if ($request->type === 'layanan') {
                    $results = $layananQuery->get()->map(function($item) {
                        $item->type = 'layanan';
                        return $item;
                    });
                } else {
                    $results = $paketQuery->get()->map(function($item) {
                        $item->type = 'paket';
                        return $item;
                    });
                }
            } else {
                // If no type filter, get both
                $layanans = $layananQuery->get()->map(function($item) {
                    $item->type = 'layanan';
                    return $item;
                });
                $pakets = $paketQuery->get()->map(function($item) {
                    $item->type = 'paket';
                    return $item;
                });
                $results = $layanans->concat($pakets);
            }

            // Sort the results
            if ($request->filled('sort')) {
                $results = $results->sortBy(function($item) use ($request) {
                    switch ($request->sort) {
                        case 'price-low':
                            return $item->type === 'layanan' ? $item->harga_layanan : $item->harga_paket;
                        case 'price-high':
                            return -($item->type === 'layanan' ? $item->harga_layanan : $item->harga_paket);
                        case 'newest':
                            return -strtotime($item->created_at);
                        case 'popular':
                            return -strtotime($item->created_at);
                        default:
                            return -strtotime($item->created_at);
                    }
                });
            } else {
                $results = $results->sortByDesc('created_at');
            }

            // Paginate the results
            $page = $request->get('page', 1);
            $perPage = 9;
            $items = $results->forPage($page, $perPage);
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'items' => $items->values(),
                    'total' => $results->count(),
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($results->count() / $perPage)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching the data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $layanan = Layanan::with(['kategori'])->find($id);
            
            if (!$layanan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Layanan not found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $layanan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching the layanan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 