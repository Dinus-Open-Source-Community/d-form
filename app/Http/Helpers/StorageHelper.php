<?php

namespace App\Helpers;

class StorageHelper
{
    /**
     * Generate public URL for a storage file safely.
     *
     * @param string|null $path
     * @return string|null
     */
    public static function fileUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        // rawurlencode setiap bagian path untuk keamanan URL
        $parts = explode('/', $path);
        $encoded = array_map('rawurlencode', $parts);

        return asset('storage/' . implode('/', $encoded));
    }
}
