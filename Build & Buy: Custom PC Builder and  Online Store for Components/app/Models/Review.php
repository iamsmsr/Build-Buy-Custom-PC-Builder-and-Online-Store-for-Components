<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Specify the table name (optional if it follows naming convention)
    protected $table = 'reviews';

    // Columns that can be mass-assigned
    protected $fillable = [
        'product_id',
        'user_id',
        'review_type',
        'star',
        'remark',
        'comment',  // Add 'comment' to the fillable array
    ];
}
