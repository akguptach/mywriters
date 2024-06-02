<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequestMessage extends Model
{
    use HasFactory;
    protected $table = 'order_request_messages';
    protected $fillable = [
        'sendertable_id',
        'sendertable_type',
        'receivertable_id',
        'receivertable_type',
        'request_id',
        'message',
        'attachment',
        'read',
        'url',
        'type'
    ];



    public function sendertable()
    {
        return $this->morphTo();
    }

    public function receivertable()
    {
        return $this->morphTo();
    }

    public function request()
    {
        return $this->belongsTo('App\Models\OrderRequest', 'request_id');
    }
}
