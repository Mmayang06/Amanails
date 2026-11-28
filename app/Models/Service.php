<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'category_label',
        'service_type',
        'price',
        'duration',
        'image',
        'uploaded_by',
        'uploader_role',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Accessor URL gambar melalui storage link.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('img/gallery-1.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        if (file_exists(storage_path('app/public/'.$this->image))) {
            return asset('storage/'.$this->image);
        }

        // Fallback untuk data seeder berawalan 'nails/...' agar tetap terbaca dari public/img/
        $fallbackImg = 'img/'.basename($this->image);
        if (file_exists(public_path($fallbackImg))) {
            return asset($fallbackImg);
        }

        return asset('img/gallery-1.jpg');
    }
}
