<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

      protected $guarded = [];

      protected $table = 'reviews';

    protected $fillable = [
        'user_id', 'business_id', 'review', 'stars'
    ];

     public function user(): BelongsTo
      {
        return $this->belongsTo(User::class);
      }

       public function business(): BelongsTo
      {
        return $this->belongsTo(Business::class);
      }
}
