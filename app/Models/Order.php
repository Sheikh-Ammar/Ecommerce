<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // ORDER ONE-MANY USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ORDER ONE-MANY PRODUCT
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
