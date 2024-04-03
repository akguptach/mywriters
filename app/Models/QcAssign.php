<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcAssign extends Model
{
    use HasFactory;
    protected $table = 'qc_assign';
    protected $fillable = ['order_id', 'student_id', 'qc_id', 'qc_price'];
    public function qc()
    {
        return $this->belongsTo('App\Models\Tutor', 'qc_id');
    }
}
