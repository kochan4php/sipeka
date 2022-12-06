<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
  public static function generateUniqueUsername(string $prefix, int $randomStringLength, string $name): string
  {
    return strtolower($prefix . Str::random($randomStringLength) . '-' . Str::slug($name));
  }
}
