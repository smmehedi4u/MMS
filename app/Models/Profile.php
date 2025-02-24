<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'deposit_id', 'meal_id', 'others_id', 'net'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function others()
    {
        return $this->belongsTo(Others::class);
    }
}
