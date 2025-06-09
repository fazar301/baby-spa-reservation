<x-main-layout>
  <!-- Header Section -->
  <section class="pt-24 pb-12 bg-gradient-to-br from-babypink-50 via-white to-babyblue-50">
    <div class="container mx-auto px-4">
      <div class="text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          Artikel & Tips Perawatan Bayi
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
          Temukan informasi terkini seputar perawatan bayi, tips spa, dan panduan 
          perkembangan anak dari para ahli kami.
        </p>
      </div>
    </div>
  </section>

  <!-- Filter Section -->
  <section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4">
      <form action="{{ route('artikel.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
        <div class="relative flex-1 max-w-md" style="width:100%;">
          <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <input
            name="search"
            type="text"
            value="{{ request('search') }}"
            placeholder="Cari artikel..."
            class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent"
          />
        </div>
        <div class="flex flex-wrap gap-2">
          <button type="submit" name="category" value="all" class="category-btn {{ !request('category') || request('category') === 'all' ? 'bg-babypink-500 text-white' : 'border border-babypink-500 text-babypink-500 hover:bg-babypink-50' }} px-4 py-2 rounded transition-colors">
            Semua Kategori
          </button>
          @foreach($categories as $category)
          <button type="submit" name="category" value="{{ $category->slug }}" class="category-btn {{ request('category') === $category->slug ? 'bg-babypink-500 text-white' : 'border border-babypink-500 text-babypink-500 hover:bg-babypink-50' }} px-4 py-2 rounded transition-colors">
            {{ $category->nama }}
          </button>
          @endforeach
        </div>
      </form>
    </div>
  </section>

  <!-- Articles Grid -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      @if($artikels->isEmpty())
        <div class="text-center py-12">
          <p class="text-gray-500 text-lg">Tidak ada artikel yang ditemukan.</p>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
          @foreach($artikels as $artikel)
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
              <div class="relative">
                <img 
                  src="{{ $artikel->thumbnail ? '/storage/' . $artikel->thumbnail : '/images/default-article.jpg' }}" 
                  alt="{{ $artikel->judul }}" 
                  class="h-48 w-full object-cover"
                >
                <div class="absolute top-3 left-3">
                  <span class="bg-babypink-500 text-white px-2 py-1 rounded text-xs font-medium">
                    {{ $artikel->kategori->nama }}
                  </span>
                </div>
              </div>
              <div class="p-4 md:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                  {{ $artikel->judul }}
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                  {{ $artikel->meta_description ?? Str::limit(strip_tags($artikel->konten), 150) }}
                </p>
                
                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                  <div class="flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ $artikel->author->name }}</span>
                  </div>
                  <div class="flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $artikel->published_at->format('d F Y') }}</span>
                  </div>
                </div>
                
                <a href="{{ route('artikel.show', $artikel->slug) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors group">
                  Baca Selengkapnya
                  <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </a>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
          {{ $artikels->links() }}
        </div>
      @endif
    </div>
  </section>
</x-main-layout>