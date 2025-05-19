<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stay extends Model
{
    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
    ];

    protected $cast = [
        'check_in' => 'date',
        'check_out' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
