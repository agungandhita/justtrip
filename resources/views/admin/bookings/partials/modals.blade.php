<!-- Confirm Modal -->
<div id="confirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop Blur -->
        <div class="fixed inset-0 transition-opacity bg-indigo-950/60 backdrop-blur-sm" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-10 border border-gray-100">
            <form id="confirmForm" method="POST" class="relative z-10">
                @csrf
                @method('PATCH')
                
                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 mx-auto bg-emerald-50 rounded-3xl shadow-lg shadow-emerald-100 mb-6 transition-transform hover:scale-110">
                        <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-gray-900 leading-tight mb-2" id="modal-title">Konfirmasi Wisata</h3>
                    <p class="text-sm text-gray-500 font-medium px-4">Apakah Anda yakin ingin menyetujui pesanan ini? Aksi ini akan mengubah status menjadi <span class="text-emerald-600 font-bold uppercase tracking-widest text-[10px]">Confirmed</span>.</p>
                </div>

                <div class="mt-8">
                    <label for="confirm_notes" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Internal Notes (Opsional)</label>
                    <textarea name="notes" id="confirm_notes" rows="3" 
                              class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all text-sm font-medium resize-none shadow-sm" 
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4">
                    <button type="button" onclick="closeModal('confirmModal')" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-gray-500 bg-gray-100 rounded-2xl hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-white bg-emerald-600 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop Blur -->
        <div class="fixed inset-0 transition-opacity bg-indigo-950/60 backdrop-blur-sm" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-10 border border-gray-100">
            <form id="rejectForm" method="POST" class="relative z-10">
                @csrf
                @method('PATCH')
                
                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 mx-auto bg-rose-50 rounded-3xl shadow-lg shadow-rose-100 mb-6 transition-transform hover:scale-110">
                        <svg class="w-10 h-10 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-gray-900 leading-tight mb-2" id="modal-title">Tolak Pesanan</h3>
                    <p class="text-sm text-gray-500 font-medium px-4 text-center">Apakah Anda yakin ingin menolak pesanan ini? Berikan alasan penolakan yang jelas untuk customer.</p>
                </div>

                <div class="mt-8">
                    <label for="reject_notes" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Alasan Penolakan <span class="text-rose-500">*</span></label>
                    <textarea name="notes" id="reject_notes" rows="4" required
                              class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-rose-100 focus:border-rose-400 transition-all text-sm font-medium resize-none shadow-sm" 
                              placeholder="Sebutkan alasan penolakan..."></textarea>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4">
                    <button type="button" onclick="closeModal('rejectModal')" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-gray-500 bg-gray-100 rounded-2xl hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-white bg-rose-600 rounded-2xl hover:bg-rose-700 transition-all shadow-lg shadow-rose-100">
                        Batalkan Trip
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div id="completeModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop Blur -->
        <div class="fixed inset-0 transition-opacity bg-indigo-950/60 backdrop-blur-sm" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-10 border border-gray-100">
            <form id="completeForm" method="POST" class="relative z-10">
                @csrf
                @method('PATCH')
                
                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 mx-auto bg-blue-50 rounded-3xl shadow-lg shadow-blue-100 mb-6 transition-transform hover:scale-110">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-gray-900 leading-tight mb-2" id="modal-title">Sertifikasi Selesai</h3>
                    <p class="text-sm text-gray-500 font-medium px-4 text-center">Menandai tour ini telah selesai dengan sukses. Data akan dipindahkan ke arsip perjalanan.</p>
                </div>

                <div class="mt-8">
                    <label for="complete_notes" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Review Internal (Opsional)</label>
                    <textarea name="notes" id="complete_notes" rows="3" 
                              class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-medium resize-none shadow-sm" 
                              placeholder="Bagaimana jalannya tour?"></textarea>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4">
                    <button type="button" onclick="closeModal('completeModal')" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-gray-500 bg-gray-100 rounded-2xl hover:bg-gray-200 transition-all">
                        Kembali
                    </button>
                    <button type="submit" 
                            class="w-full px-6 py-4 text-xs font-black uppercase tracking-widest text-white bg-blue-600 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                        Finalisasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>