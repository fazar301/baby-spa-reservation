{{-- Paket layanan view - Created by yolapebriyeni --}}
                        <div class="mt-auto pt-4">
                            <a href="{{ route('reservasi.redirect', ['type' => 'paket', 'slug' => $item->slug]) }}" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Reservasi
                            </a>
                        </div> 