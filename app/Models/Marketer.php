<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'accessories', 'amount', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
