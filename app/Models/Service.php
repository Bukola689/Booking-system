<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

      protected $guarded = [];

      protected $table = 'services';

    protected $fillable = [
        'business_id', 'name', 'description', 'price'
    ];

     public function business(): BelongsTo
      {
        return $this->belongsTo(Business::class);
      }
}
