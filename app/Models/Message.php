<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'apartment_id',
        'apartment_id',
        'id',
        'apartments',
        'sender',
        'guest user',
        'email',
        'subject',
        'message',
    ];

    public function apartment(){
    return $this->belongsTo(Apartment::class);
    }
}