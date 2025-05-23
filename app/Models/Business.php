<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'businesses';

    protected $fillable = [
        'user_id', 'name', 'opening_hours', 'status'
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

}
