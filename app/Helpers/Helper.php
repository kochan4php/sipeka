<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helper
{
  public static function generateUniqueUsername(string $prefix, int $randomStringLength, string $name, bool $uppercase = true): string
  {
    $username = $prefix . '-' . Str::random($randomStringLength) . '-' . Str::slug($name);
    return $uppercase ? strtoupper($username) : strtolower($username);
  }

  public static function deleteFileIfExistsInStorageFolder(?string $path): void
  {
    if (!is_null($path) && Storage::exists($path)) Storage::delete($path);
  }

  public static function deleteMultipleFileIfExistsInStorageFolder(...$path): void
  {
    foreach ($path as $p) :
      self::deleteFileIfExistsInStorageFolder($p);
    endforeach;
  }
}
