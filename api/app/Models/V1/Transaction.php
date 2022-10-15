<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESSFUL = 'success';

    protected $fillable = [
        "sender_id",
        "receiver_id",
        "send_amount",
        "exchange_amount",
        "send_currency",
        "exchange_currency",
        "status"
    ];
}
