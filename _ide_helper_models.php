<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read mixed $age
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Baby newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Baby newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Baby query()
 */
	class Baby extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $nama
 * @property \Illuminate\Support\Carbon $tanggal_lahir
 * @property string $jenis_kelamin
 * @property numeric $berat_lahir
 * @property numeric $berat_sekarang
 * @property bool $is_temporary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservasis
 * @property-read int|null $reservasis_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereBeratLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereBeratSekarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereIsTemporary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bayi whereUserId($value)
 */
	class Bayi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_kategori
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Layanan> $layanans
 * @property-read int|null $layanans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaketLayanan> $paketLayanans
 * @property-read int|null $paket_layanans_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereNamaKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_layanan
 * @property string $slug
 * @property int $harga_layanan
 * @property string $deskripsi
 * @property string $image
 * @property array<array-key, mixed>|null $manfaat
 * @property int $kategori_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kategori $kategori
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaketLayanan> $paketLayanans
 * @property-read int|null $paket_layanans_count
 * @method static \Database\Factories\LayananFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereHargaLayanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereManfaat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereNamaLayanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Layanan whereUpdatedAt($value)
 */
	class Layanan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_paket
 * @property string $slug
 * @property int $harga_paket
 * @property string $deskripsi
 * @property string $image
 * @property int $kategori_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kategori $kategori
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Layanan> $layanans
 * @property-read int|null $layanans_count
 * @method static \Database\Factories\PaketLayananFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereHargaPaket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereNamaPaket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaketLayanan whereUpdatedAt($value)
 */
	class PaketLayanan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $kode
 * @property int $user_id
 * @property int $layanan_id
 * @property string $type
 * @property int $sesi_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $bayi_id
 * @property \Illuminate\Support\Carbon $tanggal_reservasi
 * @property numeric $harga
 * @property string|null $catatan
 * @property-read \App\Models\Ulasan|null $ulasan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereBayiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereLayananId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereSesiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereTanggalReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereUserId($value)
 */
	class Reservasi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $kode
 * @property int $user_id
 * @property int $layanan_id
 * @property string $type
 * @property int $sesi_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $bayi_id
 * @property \Illuminate\Support\Carbon $tanggal_reservasi
 * @property numeric $harga
 * @property string|null $catatan
 * @property-read \App\Models\Bayi|null $bayi
 * @property-read \App\Models\Layanan $layanan
 * @property-read \App\Models\PaketLayanan $paketLayanan
 * @property-read \App\Models\Layanan $service
 * @property-read \App\Models\Sesi $sesi
 * @property-read \App\Models\Transaksi|null $transaksi
 * @property-read \App\Models\Ulasan|null $ulasan
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Voucher|null $voucher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereBayiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereLayananId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereSesiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereTanggalReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $jam
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi whereJam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sesi whereUpdatedAt($value)
 */
	class Sesi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $order_id
 * @property int $reservasi_id
 * @property \Illuminate\Support\Carbon $tanggal
 * @property numeric $jumlah
 * @property numeric $discount_amount
 * @property string $status
 * @property string $metode
 * @property string|null $snap_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Reservation $reservasi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereMetode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereReservasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereSnapToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereUpdatedAt($value)
 */
	class Transaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $reservasis_id
 * @property int $user_id
 * @property string $nama_layanan
 * @property int $rating
 * @property string|null $feedback
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Reservasi $reservasi
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereNamaLayanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereReservasisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereUserId($value)
 */
	class Ulasan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $noHP
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $gauth_id
 * @property string|null $gauth_type
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservasis
 * @property-read int|null $reservasis_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGauthId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGauthType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoHP($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property numeric $discount_amount
 * @property string $discount_type
 * @property int|null $max_uses
 * @property int $used_count
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereMaxUses($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUsedCount($value)
 */
	class Voucher extends \Eloquent {}
}

