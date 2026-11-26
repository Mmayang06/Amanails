<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'service_id',
        'item_name',
        'item_type',
        'price',
        'duration',
        'is_addon',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration' => 'integer',
        'is_addon' => 'boolean',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
