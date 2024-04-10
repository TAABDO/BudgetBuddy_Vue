<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'Description',
        'date',
        'user_id',
        'update at',
        'created at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
