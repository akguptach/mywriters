<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssign extends Model
{
    use HasFactory;
    protected $table = 'order_assign';
    protected $fillable = ['order_id', 'student_id', 'tutor_id', 'tutor_price', 'message', 'status', 'attachment'];


    public function teacher()
    {
        return $this->belongsTo('App\Models\Tutor', 'tutor_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
