<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelStudy extends Model
{
    use HasFactory;
    protected $table = 'level_study';
    protected $fillable = ['level_name', 'price', 'website_type', 'status'];
}
