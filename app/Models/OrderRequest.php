<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;
    protected $table = 'order_request';
    protected $fillable = ['order_id', 'student_id', 'tutor_id', 'message', 'admin_id', 'delivery_date'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
