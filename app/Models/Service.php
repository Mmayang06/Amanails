<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'category_label',
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

        // Render menggunakan Storage link (storage/nails/...)
        return asset('storage/'.$this->image);
    }
}
