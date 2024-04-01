<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['title', 'task', 'delivery_date', 'website_id', 'subject_id', 'task_type_id', 'studylabel_id', 'grade_id', 'referencing_style_id', 'no_of_words', 'price', 'student_id', 'payment_status', 'task_status', 'writer_id', 'qc_id', 'rating', 'review', 'currency_code'];
    public $timestamps = true;


    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    public function teacherAssigned()
    {
        return $this->hasOne('App\Models\OrderAssign', 'order_id');
    }

    public function qcAssigned()
    {
        return $this->hasOne('App\Models\QcAssign', 'order_id');
    }

    public function lavelStudy()
    {
        return $this->belongsTo('App\Models\LevelStudy', 'studylabel_id');
    }

    public function taskType()
    {
        return $this->belongsTo('App\Models\TaskType', 'task_type_id');
    }

    public function referencingStyle()
    {
        return $this->belongsTo('App\Models\ReferencingStyle', 'referencing_style_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }
}
