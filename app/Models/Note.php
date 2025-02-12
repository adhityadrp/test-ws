<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'subject',
        'message',
    ];

    public function to()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }
}
