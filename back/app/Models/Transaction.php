<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Transaction extends Model
{
    use HasFactory,  softDeletes;
    protected $table = 'ticket_transactions';
    protected $fillable = [
        'user_id',
        'conta_pagar_id',
        'accounts_id',
        'is_liquidation',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}