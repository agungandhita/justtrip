/**
 * Alpine.js component untuk Guest Booking form
 * Fitur:
 * - Fetch layanan berdasarkan destinasi
 * - Auto-populate layanan select jika ada yang match
 * - Suggest tanggal, jumlah orang, dan harga berdasarkan layanan
 */

// Global Alpine component registration untuk guest booking
document.addEventListener('alpine:init', () => {
    Alpine.data('guestBookingSearch', () => ({
        destinasi: '',
        layananList: [],
        loading: false,
        error: null,
        selectedLayanan: null,
        
        // Fetch layanan dari API berdasarkan destinasi
        async searchLayanan() {
            if (!this.destinasi || this.destinasi.trim().length < 3) {
                this.layananList = [];
                this.error = null;
                return;
            }
            
            this.loading = true;
            this.error = null;
            
            try {
                const response = await fetch(`/api/layanan/search?destinasi=${encodeURIComponent(this.destinasi)}`);
                const data = await response.json();
                
                if (data.success) {
                    this.layananList = data.data || [];
                    
                    // Jika ada layanan yang ditemukan, auto-select yang pertama
                    if (this.layananList.length > 0) {
                        this.selectLayanan(this.layananList[0]);
                    } else {
                        this.selectedLayanan = null;
                    }
                } else {
                    this.error = data.message || 'Gagal mencari layanan';
                    this.layananList = [];
                }
            } catch (err) {
                this.error = `Error: ${err.message}`;
                this.layananList = [];
            } finally {
                this.loading = false;
            }
        },
        
        // Select layanan dan populate suggestions
        selectLayanan(layanan) {
            this.selectedLayanan = layanan;
            
            // Update hidden input untuk layanan_id jika ada form
            const layananIdInput = document.querySelector('input[name="layanan_id"]');
            if (layananIdInput) {
                layananIdInput.value = layanan.layanan_id;
            }
            
            // Suggest durasi hari
            const durasiInput = document.querySelector('input[name="durasi_hari_diinginkan"]');
            if (durasiInput && layanan.durasi_hari) {
                durasiInput.value = layanan.durasi_hari;
            }
            
            // Update price display jika ada
            this.updatePriceDisplay(layanan);
            
            // Dispatch event untuk notify parent
            document.dispatchEvent(new CustomEvent('layanan-selected', { detail: layanan }));
        },
        
        // Update tampilan harga berdasarkan jumlah peserta
        updatePriceDisplay(layanan) {
            const participantInput = document.querySelector('select[name="jumlah_peserta"]') || 
                                     document.querySelector('input[name="jumlah_peserta"]');
            const totalPriceElement = document.getElementById('totalPrice');
            const participantCountElement = document.getElementById('participantCount');
            
            if (participantInput && totalPriceElement && layanan.harga_mulai) {
                const updatePrice = () => {
                    const participants = parseInt(participantInput.value) || 1;
                    const totalPrice = layanan.harga_mulai * participants;
                    totalPriceElement.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                    if (participantCountElement) {
                        participantCountElement.textContent = participants;
                    }
                };
                
                // Update immediately
                updatePrice();
                
                // Listen to changes
                participantInput.addEventListener('change', updatePrice);
                participantInput.addEventListener('input', updatePrice);
            }
        },
        
        // Format harga ke format Indonesia
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        }
    }));
});
