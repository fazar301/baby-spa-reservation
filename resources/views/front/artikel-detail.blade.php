<x-main-layout>
    <style>
        ul{
            list-style: inherit;
        }
    </style>
    <!-- Article Content -->
    <article class="pt-24 pb-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="/artikel" style="margin-top:30px;" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>

            <!-- Article Header -->
            <header class="mb-8">
                <span class="inline-block bg-babypink-500 text-white px-3 py-1 rounded-full text-sm font-medium mb-4">
                    {{ $artikel->kategori->nama }}
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $artikel->judul }}
                </h1>
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex items-center gap-6 text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ $artikel->author->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $artikel->published_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button id="like-btn" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Suka
                        </button>
                        <button id="share-btn" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div class="mb-8">
                <img 
                    src="{{ $artikel->thumbnail ? '/storage/' . $artikel->thumbnail : '/images/default-article.jpg' }}" 
                    alt="{{ $artikel->judul }}"
                    class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg"
                />
            </div>

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-12" style="line-height: 1.8; font-size: 1.1rem;">
                {!! $artikel->konten !!}
            </div>

            <!-- Call to Action -->
            <div class="bg-babypink-50 rounded-lg p-6 md:p-8 mb-12 text-center">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">
                    Ingin Pengalaman Spa Profesional untuk Si Kecil?
                </h3>
                <p class="text-gray-600 mb-6">
                    Tim terapis berpengalaman kami siap memberikan perawatan terbaik untuk bayi Anda 
                    dengan teknik yang aman dan menyenangkan.
                </p>
                <a href="/login" class="bg-babypink-500 hover:bg-babypink-600 text-white px-6 py-3 rounded transition-colors">
                    Reservasi Sekarang
                </a>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center">
                Artikel Terkait
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($relatedArticles as $related)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <a href="{{ route('artikel.show', $related->slug) }}">
                        <img 
                            src="{{ $related->thumbnail ? '/storage/' . $related->thumbnail : '/images/default-article.jpg' }}" 
                            alt="{{ $related->judul }}"
                            class="h-48 w-full object-cover"
                        />
                        <div class="p-4">
                            <span class="inline-block bg-babypink-500 text-white px-2 py-1 rounded text-xs font-medium mb-2">
                                {{ $related->kategori->nama }}
                            </span>
                            <h4 class="font-semibold text-gray-900 line-clamp-2">
                                {{ $related->judul }}
                            </h4>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>