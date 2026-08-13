<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'layanan';
    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'nama_layanan',
        'slug',
        'jenis_layanan',
        'deskripsi',
        'information_image',
        'itinerary',
        'start_time',
        'finish_time',
        'itinerary_note',
        'include_services',
        'exclude_services',
        'destinations',
        'pricing_options',
        'terms_conditions',
        'harga_mulai',
        'durasi_hari',
        'maks_orang',
        'status',
        'catatan',
        'lokasi_tujuan',
        'fasilitas',
        'gambar_destinasi'
    ];

    protected $casts = [
        'harga_mulai' => 'decimal:2',
        'durasi_hari' => 'integer',
        'fasilitas' => 'array',
        'gambar_destinasi' => 'array',
        'itinerary' => 'array',
        'include_services' => 'array',
        'exclude_services' => 'array',
        'destinations' => 'array',
        'pricing_options' => 'array',
        'terms_conditions' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Accessor untuk format harga
    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format((float) $this->harga_mulai, 0, ',', '.');
    }

    // Accessor untuk format durasi
    public function getDurasiFormatAttribute()
    {
        return $this->durasi_hari . ' hari ' . ($this->durasi_hari - 1) . ' malam';
    }

    // Accessor untuk gambar utama (gambar pertama)
    public function getGambarUtamaAttribute()
    {
        $gambar = $this->gambar_destinasi;
        return !empty($gambar) && is_array($gambar) ? $gambar[0] : null;
    }

    // Method untuk menambah gambar destinasi
    public function addGambarDestinasi($imagePath)
    {
        $gambar = $this->gambar_destinasi ?? [];

        // Validasi maksimal 5 gambar
        if (count($gambar) >= 5) {
            throw new \Exception('Maksimal 5 gambar destinasi yang diizinkan');
        }

        $gambar[] = $imagePath;
        $this->gambar_destinasi = $gambar;
        return $this;
    }

    // Method untuk menghapus gambar destinasi
    public function removeGambarDestinasi($imagePath)
    {
        $gambar = $this->gambar_destinasi ?? [];
        $gambar = array_filter($gambar, function($path) use ($imagePath) {
            return $path !== $imagePath;
        });
        $this->gambar_destinasi = array_values($gambar);
        return $this;
    }

    // Accessor untuk label jenis layanan
    public function getJenisLayananLabelAttribute()
    {
        $labels = [
            'open_trip' => 'Open Trip',
            'corporate_trip' => 'Corporate Trip',
            'edu_trip' => 'Edu Trip',
        ];

        return $labels[$this->jenis_layanan] ?? $this->jenis_layanan;
    }



    // Scope untuk status aktif
    public function scopeAktif($query)

    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_layanan', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }

    // Scope untuk filter jenis layanan
    public function scopeJenisLayanan($query, $jenis)
    {
        return $query->where('jenis_layanan', $jenis);
    }

    // Static method untuk mendapatkan opsi jenis layanan
    public static function getJenisLayananOptions()
    {
        return [
            'open_trip' => 'Open Trip',
            'corporate_trip' => 'Corporate Trip',
            'edu_trip' => 'Edu Trip',
        ];
    }

    // Relationships
    public function specialOffers()
    {
        return $this->hasMany(SpecialOffer::class, 'layanan_id', 'layanan_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'layanan_id', 'layanan_id');
    }

    // Method to check if layanan has active special offers
    public function hasActiveSpecialOffers()
    {
        return $this->specialOffers()
            ->where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->exists();
    }

    // Method to get current active special offer
    public function getCurrentSpecialOffer()
    {
        return $this->specialOffers()
            ->where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->first();
    }

    // Method to get discounted price if special offer exists
    public function getDiscountedPrice()
    {
        $specialOffer = $this->getCurrentSpecialOffer();
        if ($specialOffer) {
            return $specialOffer->discounted_price;
        }
        return $this->harga_mulai;
    }

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = $layanan->generateSlug($layanan->nama_layanan);
            }
        });

        static::updating(function ($layanan) {
            if ($layanan->isDirty('nama_layanan') && empty($layanan->slug)) {
                $layanan->slug = $layanan->generateSlug($layanan->nama_layanan);
            }
        });
    }

    // Method untuk generate slug
    private function generateSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('layanan_id', '!=', $this->layanan_id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
