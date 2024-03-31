<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Tutor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'tutor';
    protected $fillable = ['tutor_name','tutor_email','tutor_mobile','tutor_subject','password'];
}
