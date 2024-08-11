<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcOrderMessage extends Model
{
    use HasFactory;
    protected $table = 'qc_order_messages';
    protected $fillable = ['sendertable_id', 'sendertable_type', 'receivertable_id', 'receivertable_type', 'order_id', 'message', 'attachment','url'];



    public function sendertable()
    {
        return $this->morphTo();
    }

    public function receivertable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }


}
