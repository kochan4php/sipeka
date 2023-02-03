<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helper {
  public static function generateUniqueCharacters(int $length = 5): string {
    $charNumber = '1234567890';
    $number = '';

    for ($i = 0; $i <= $length; $i++) {
      $randomNumber = (int) round(rand(1, 9));
      $number .= substr($charNumber, $randomNumber, 1);
    }

    return $number . strtoupper(Str::random(10));
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

  public static function generateUniqueCode(string $prefix, string $separator = '-', int $length = 10) {
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
