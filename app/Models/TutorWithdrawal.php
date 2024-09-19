<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorWithdrawal extends Model
{
    protected $table = 'tutor_withdrawals';
    protected $fillable=[
        'tutor_id',
        'amount',
        'status',
        'balance'
    ];
    public function tutor()
	{
		return $this->belongsTo('App\Models\Tutor', 'tutor_id');
	}
}
