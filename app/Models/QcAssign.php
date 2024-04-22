<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcAssign extends Model
{
    use HasFactory;
    protected $table = 'qc_assign';
    protected $fillable = ['order_id', 'student_id', 'qc_id', 'qc_price', 'message', 'status', 'attachment'];

    public function qc()
    {
        return $this->belongsTo('App\Models\Tutor', 'qc_id');
    }



    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
