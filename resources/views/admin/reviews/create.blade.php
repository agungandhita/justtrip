@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4 text-center">
            <div class="inline-flex p-4 bg-teal-50 rounded-3xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-black text-gray-800 tracking-tight">Tambah Ulasan Baru</h1>
            <p class="text-gray-500 max-w-lg mx-auto mt-2 font-medium italic">"Testimoni jujur adalah permata terbaik bagi biro perjalanan."</p>
        </div>

        <!-- Form Container -->
        <div class="max-w-5xl mx-auto px-4">
            <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                @csrf

                <!-- Left Column: Primary Info -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                            <span class="w-8 h-1 bg-teal-500 rounded-full"></span>
                            Informasi Pelanggan
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <label for="customer_name" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap Customer <span class="text-red-500">*</span></label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Contoh: Andi Wijaya" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3.5 px-5 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300" required>
                                @error('customer_name')
                                    <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-1">
                                <label for="customer_position" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Jabatan / Profesi</label>
                                <input type="text" id="customer_position" name="customer_position" value="{{ old('customer_position') }}" placeholder="Contoh: Direktur PT Sukses" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3.5 px-5 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300">
                                @error('customer_position')
                                    <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="content" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Isi Ulasan <span class="text-red-500">*</span></label>
                                <textarea id="content" name="content" rows="6" placeholder="Tuliskan pengalaman luar biasa pelanggan Anda di sini..." class="w-full bg-gray-50 border-gray-100 rounded-2xl py-4 px-5 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                            <span class="w-8 h-1 bg-orange-500 rounded-full"></span>
                            Detail Perjalanan
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <label for="destination" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Destinasi <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <input type="text" id="destination" name="destination" value="{{ old('destination') }}" placeholder="Masukkan nama kota/wisata" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3.5 pl-12 pr-5 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300" required>
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('destination')
                                    <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-1">
                                <label for="rating" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Rating Keberangkatan</label>
                                <select id="rating" name="rating" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3.5 px-5 text-gray-700 font-bold focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300 appearance-none cursor-pointer">
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Bintang {{ str_repeat('★', $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings & Media -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 text-center">
                        <h3 class="text-sm font-black text-gray-800 mb-6 uppercase tracking-wider">Foto Customer</h3>
                        
                        <div class="mb-4 flex justify-center">
                            <div id="avatar-preview" class="w-32 h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-[2rem] flex flex-col items-center justify-center overflow-hidden transition-all duration-300 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">NO IMAGE</span>
                            </div>
                        </div>
                        
                        <label class="inline-block">
                            <span class="sr-only">Pilih Foto</span>
                            <input type="file" name="customer_avatar" id="avatar-input" accept="image/*" class="block w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 cursor-pointer">
                        </label>
                        <p class="mt-3 text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Format: JPG/PNG, maks 2MB.</p>
                        @error('customer_avatar')
                            <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-sm font-black text-gray-800 mb-6 uppercase tracking-wider text-center">Pengaturan</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="order" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 text-center">Urutan Tampil</label>
                                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3 px-5 text-gray-700 text-center font-bold focus:ring-2 focus:ring-teal-500/20 transition-all duration-300">
                            </div>
                            
                            <div class="pt-4 flex justify-center">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600 shadow-inner"></div>
                                    </div>
                                    <span class="text-xs font-black text-gray-700 group-hover:text-teal-600 transition-colors uppercase tracking-widest">Publish</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 pt-4">
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-black py-4 rounded-3xl shadow-xl shadow-teal-100 transition-all duration-300 transform hover:translate-y-[-2px] active:scale-95 uppercase tracking-widest text-sm">
                            Publish Review
                        </button>
                        <a href="{{ route('admin.reviews.index') }}" class="w-full bg-white border-2 border-gray-100 text-center text-gray-400 font-black py-4 rounded-3xl hover:bg-gray-50 transition-all duration-300 uppercase tracking-widest text-[10px]">
                            Batalkan
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('avatar-input').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const preview = document.getElementById('avatar-preview');
                preview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
                preview.classList.remove('border-dashed');
                preview.classList.add('border-solid', 'border-teal-500');
            }
        }
    </script>
@endsection
