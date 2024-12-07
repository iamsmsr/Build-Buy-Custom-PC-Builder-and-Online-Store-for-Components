<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'orders';

    // Define the fillable attributes
    protected $fillable = [
        'user_id', 'total_price', 'status', 'order_details' // Added 'order_details'
    ];

    // If you want to automatically handle timestamps, Laravel does this by default
    public $timestamps = true;
}
