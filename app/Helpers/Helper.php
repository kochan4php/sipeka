<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Http\Controllers\CloudinaryStorageController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helper {
    public static function generateUniqueNumber(int $length = 10): string {
        $charNumber = '1234567890';
        $number = '';

        for ($i = 0; $i <= $length; $i++) {
            $randomNumber = (int) round(rand(1, 9));
            $number .= substr($charNumber, $randomNumber, 1);
        }

        return $number;
    }

    public static function getRandomTypeOfCompany(): string {
        $companyType = [
            'PT',
            'CV',
            'Firma',
            'Persero'
        ];

        $randomNumber = (int) round(rand(0, 3));

        return $companyType[$randomNumber];
    }

    public static function getRandomCategoryForMitra(): string {
        $category = [
            'Akuntansi / Keuangan',
            'Sumber Daya Manusia',
            'Penjualan / Pemasaran',
            'Seni/Media/Komunikasi',
            'Pelayanan',
            'Hotel/Restoran',
            'Pendidikan/Pelatihan',
            'Komputer/Teknologi Informasi',
            'Teknik',
            'Manufaktur',
            'Bangunan/Konstruksi',
            'Sains',
            'Layanan Kesehatan',
            'Lainnya'
        ];

        $randomNumber = (int) round(rand(0, 13));

        return $category[$randomNumber];
    }

    public static function getRandomCity(): string {
        $city = [
            'Banda Aceh',
            'Langsa',
            'Lhokseumawe',
            'Sabang',
            'Subulussalam',
            'Denpasar',
            'Pangkal Pinang',
            'Cilegon',
            'Serang',
            'Tangerang Selatan',
            'Tangerang',
            'Bengkulu',
            'Yogyakarta',
            'Gorontalo',
            'Kota Administrasi Jakarta Barat',
            'Kota Administrasi Jakarta Pusat',
            'Kota Administrasi Jakarta Selatan',
            'Kota Administrasi Jakarta Timur',
            'Kota Administrasi Jakarta Utara',
            'Sungai Penuh',
            'Jambi',
            'Bandung',
            'Bekasi',
            'Bogor',
            'Cimahi',
            'Cirebon',
            'Depok',
            'Sukabumi',
            'Tasikmalaya',
            'Banjar',
            'Magelang',
            'Pekalongan',
            'Salatiga',
            'Semarang',
            'Surakarta',
            'Tegal',
            'Batu',
            'Blitar',
            'Kediri',
            'Madiun',
            'Malang',
            'Mojokerto',
            'Pasuruan',
            'Probolinggo',
            'Surabaya',
            'Pontianak',
            'Singkawang',
            'Banjarbaru',
            'Banjarmasin',
            'Palangkaraya',
            'Balikpapan',
            'Bontang',
            'Samarinda',
            'Tarakan',
            'Batam',
            'Tanjungpinang',
            'Bandar Lampung',
            'Metro',
            'Ternate',
            'Tidoro Kepulauan',
            'Bima',
            'Mataram',
            'Ambon',
            'Tual',
            'Kupang',
            'Sorong',
            'Jayapura',
            'Dumai',
            'Pekanbaru',
            'Makassar',
            'Palopo',
            'Parepare',
            'Palu',
            'Baubau',
            'Kendari',
            'Bitung',
            'Kotamobagu',
            'Manado',
            'Tomohon',
            'Bukittinggi',
            'Padang',
            'Padang Panjang',
            'Pariaman',
            'Payakumbuh',
            'Sawahlunto',
            'Solok',
            'Lubuklinggau',
            'Pagar Alam',
            'Palembang',
            'Prabumulih',
            'Sekayu',
            'Binjai',
            'Gunungsitoli',
            'Medan',
            'Padang Sidempuan',
            'Pematangsiantar',
            'Sibolga',
            'Tanjungbalai',
            'Tebing Tinggi'
        ];

        $randomNumber = (int) round(rand(0, 98));

        return $city[$randomNumber];
    }

    public static function generateUniqueUsername(
        string $prefix,
        int $randomStringLength,
        string $name,
        bool $uppercase = true
    ): string {
        $username = $prefix . Str::random($randomStringLength) . Str::slug($name, '');
        return $uppercase ? strtoupper($username) : strtolower($username);
    }

    public static function generateUniqueSlug(string $name): string {
        return strtolower(Str::slug($name) . '-' . Str::random(20));
    }

    public static function generateUniqueCode(
        string $prefix,
        string $separator = '-',
        int $length = 10
    ): string {
        return strtoupper($prefix . $separator . Str::random($length));
    }

    public static function deleteFileIfExistsInStorageFolder(?string $path): void {
        if (!is_null($path) && Storage::exists($path)) Storage::delete($path);
    }

    public static function deleteMultipleFileIfExistsInStorageFolder(...$path): void {
        foreach ($path as $p) :
            self::deleteFileIfExistsInStorageFolder($p);
        endforeach;
    }
}
