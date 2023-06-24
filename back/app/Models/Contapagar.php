<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Contapagar extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'conta_pagar';
    protected $fillable = [
        'descricao',
        'valor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}