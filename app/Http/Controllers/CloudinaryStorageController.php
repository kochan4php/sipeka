<?php

namespace App\Http\Controllers;

class CloudinaryStorageController extends Controller {
    private const FOLDER_PATH = 'sipeka';

    public static function path(?string $path): string|array|null {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function upload(string $image, string $filename): ?array {
        $newFilename = str_replace(' ', '_', $filename);

        $publicId = date('Y-m-d_His') . '_' . $newFilename;

        $result = cloudinary()->upload($image, [
            'public_id' => self::path($publicId),
            'folder' => self::FOLDER_PATH,
        ]);

        $securePath = $result->getSecurePath();
        $getPublicId = $result->getPublicId();

        return compact('securePath', 'getPublicId');
    }

    public static function replace(?string $path, string $image, string $publicId): ?array {
        if (!is_null($path)) self::delete($path);
        return self::upload($image, $publicId);
    }

    public static function delete(?string $path) {
        $publicId = self::FOLDER_PATH . '/' . self::path($path);
        return cloudinary()->destroy($publicId);
    }
}
