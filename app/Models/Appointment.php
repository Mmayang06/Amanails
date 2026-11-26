<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'artist_id',
        'client_name',
        'client_phone',
        'client_type',
        'appointment_date',
        'time_slot',
        'station',
        'guests',
        'design_type',
        'custom_design_image',
        'custom_design_note',
        'dp_amount',
        'dp_payment_method',
        'dp_payment_proof',
        'dp_status',
        'initial_total',
        'addons_total',
        'final_total',
        'final_payment_method',
        'final_payment_status',
        'status',
        'total_duration',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'guests' => 'integer',
        'dp_amount' => 'integer',
        'initial_total' => 'integer',
        'addons_total' => 'integer',
        'final_total' => 'integer',
        'total_duration' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(AppointmentItem::class);
    }

    /**
     * Accessor URL gambar desain custom jika ada.
     */
    public function getCustomDesignUrlAttribute(): ?string
    {
        if (! $this->custom_design_image) {
            return null;
        }

        if (str_starts_with($this->custom_design_image, 'http://') || str_starts_with($this->custom_design_image, 'https://')) {
            return $this->custom_design_image;
        }

        return asset('storage/'.$this->custom_design_image);
    }

    /**
     * Hitung ulang total dari item layanan dan simpan ke database.
     */
    public function recalculateTotals(): void
    {
        $initialSum = (int) $this->items()->where('is_addon', false)->sum('price');
        $addonsSum = (int) $this->items()->where('is_addon', true)->sum('price');
        $totalDuration = (int) $this->items()->sum('duration');

        $this->initial_total = $initialSum * max(1, $this->guests);
        $this->addons_total = $addonsSum;
        $this->final_total = $this->initial_total + $this->addons_total;
        $this->total_duration = $totalDuration > 0 ? $totalDuration : $this->total_duration;
        $this->save();
    }
}
