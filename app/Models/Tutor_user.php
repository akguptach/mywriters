<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor_user extends Model
{
    use HasFactory;
    protected $table = 'tutor_user';
    protected $fillable = ['first_name','last_name','email'];
}
