@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4 flex flex-col md:flex-row md:items-center justify-between gap-4 max-w-5xl mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.reviews.index') }}" class="p-3 bg-white border border-gray-100 rounded-2xl text-gray-400 hover:text-teal-600 hover:border-teal-100 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight">Detail Ulasan</h1>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1 italic">ID Ulasan: #{{ str_pad($review->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 py-3.5 rounded-2xl font-black shadow-lg shadow-yellow-100 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Ulasan
                </a>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Testimonial Card Preview -->
                <div class="lg:col-span-12">
                    <div class="bg-gradient-to-br from-teal-600 to-teal-400 rounded-[3rem] p-12 shadow-2xl shadow-teal-100 relative overflow-hidden">
                        <!-- Decoration -->
                        <div class="absolute top-0 right-0 p-12 text-white opacity-10">
                            <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-12">
                            <div class="flex-shrink-0">
                                <img src="{{ $review->avatar_url }}" alt="{{ $review->customer_name }}" class="w-48 h-48 rounded-[3rem] object-cover border-8 border-white/20 shadow-2xl">
                                <div class="mt-6 flex justify-center gap-1">
                                    @for($i=1; $i<=5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $i <= $review->rating ? 'text-yellow-300' : 'text-white/30' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="flex-1 text-center md:text-left text-white">
                                <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm font-black uppercase tracking-widest">{{ $review->destination }}</span>
                                </div>
                                <h2 class="text-4xl font-black mb-1 leading-tight">{{ $review->customer_name }}</h2>
                                <p class="text-teal-50 font-bold opacity-80 uppercase tracking-widest text-sm mb-8">{{ $review->customer_position ?? 'Pelanggan Setia' }}</p>
                                
                                <blockquote class="text-xl md:text-2xl font-medium italic leading-relaxed text-teal-50 border-l-4 border-white/20 pl-8 py-2">
                                    "{{ $review->content }}"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm flex items-center gap-5">
                        <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Dibuat Pada</p>
                            <p class="text-gray-800 font-bold">{{ $review->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm flex items-center gap-5">
                        <div class="p-4 bg-teal-50 text-teal-600 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Urutan Prioritas</p>
                            <p class="text-gray-800 font-bold">#{{ $review->order }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm flex items-center gap-5">
                        <div class="p-4 {{ $review->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-400' }} rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Status Publikasi</p>
                            <p class="font-bold {{ $review->is_active ? 'text-green-600' : 'text-gray-400' }}">{{ $review->is_active ? 'PUBLISHED' : 'DRAFT' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="lg:col-span-12 flex items-center justify-between border-t border-gray-100 pt-8 mt-4">
                    <form action="{{ route('admin.reviews.toggle-active', $review->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 bg-gray-800 hover:bg-black text-white px-8 py-4 rounded-3xl font-black transition-all shadow-xl active:scale-95 uppercase tracking-widest text-xs">
                            {{ $review->is_active ? 'Sembunyikan dari Publik' : 'Terbitkan Sekarang' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini secara permanen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 font-black hover:text-red-700 transition-colors uppercase tracking-widest text-[10px] flex items-center gap-2">
                             Hapus Ulasan Selamanya
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
