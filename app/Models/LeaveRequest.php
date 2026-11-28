<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artist_name',
        'leave_type',
        'start_date',
        'end_date',
        'duration_days',
        'reason',
        'status',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'duration_days' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Format rentang tanggal cuti agar rapi untuk tampilan tabel & riwayat.
     */
    public function getFormattedDateRangeAttribute(): string
    {
        if (! $this->start_date || ! $this->end_date) {
            return '-';
        }

        if ($this->start_date->isSameDay($this->end_date)) {
            return $this->start_date->format('d M Y');
        }

        if ($this->start_date->format('M Y') === $this->end_date->format('M Y')) {
            return $this->start_date->format('d').'–'.$this->end_date->format('d M Y');
        }

        return $this->start_date->format('d M Y').' – '.$this->end_date->format('d M Y');
    }
}
