@component('mail::message')
# Penawaran Spesial Baru!

Hai, ada penawaran spesial baru dari JustTrip!

**Judul:** {{ $specialOffer->title }}

**Deskripsi:**
{{ $specialOffer->description }}

@isset($specialOffer->discounted_price)
**Harga Diskon:** Rp{{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
@endisset

@isset($specialOffer->valid_from)
**Berlaku dari:** {{ $specialOffer->valid_from }}
@endisset
@isset($specialOffer->valid_until)
**Sampai:** {{ $specialOffer->valid_until }}
@endisset

@component('mail::button', ['url' => url('/special-offers/' . $specialOffer->slug)])
Lihat Penawaran
@endcomponent

Terima kasih telah berlangganan!

Salam,
JustTrip Team
@endcomponent
