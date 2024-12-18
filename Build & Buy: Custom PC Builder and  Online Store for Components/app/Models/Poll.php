<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $table = 'polls';

    protected $fillable = [
        'type', 'poll_id', 'question', 'option1', 'option2', 'option3', 'option4',
        'vote_count1', 'vote_count2', 'vote_count3', 'vote_count4', 'is_active', 'user_id'
    ];

    // Function to get active polls
    public static function getActivePolls()
    {
        return self::where('is_active', 1)->get();
    }

    // Function to get the poll options



}
