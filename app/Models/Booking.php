<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

      protected $guarded = [];

      protected $table = 'bookings';

    protected $fillable = [
        'time', 'user_id', 'service_id'
    ];

      public function user(): BelongsTo
      {
        return $this->belongsTo(User::class);
      }

       public function service(): BelongsTo
      {
        return $this->belongsTo(Service::class);
      }

     
}
