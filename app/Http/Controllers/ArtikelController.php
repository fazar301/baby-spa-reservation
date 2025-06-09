<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        // Get all active categories first
        $categories = KategoriArtikel::where('is_active', true)->get();

        $query = Artikel::with(['kategori', 'author'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());

        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('konten', 'like', "%{$searchTerm}%")
                  ->orWhere('meta_description', 'like', "%{$searchTerm}%");
            });
        }

        // Handle category filter
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Get paginated results
        $artikels = $query->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('front.artikel', compact('artikels', 'categories'));
    }

    public function show($slug)
    {
        $artikel = Artikel::with(['kategori', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        // Get related articles from the same category
        $relatedArticles = Artikel::with(['kategori', 'author'])
            ->where('kategori_id', $artikel->kategori_id)
            ->where('id', '!=', $artikel->id)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(2)
            ->get();

        return view('front.artikel-detail', compact('artikel', 'relatedArticles'));
    }
} 