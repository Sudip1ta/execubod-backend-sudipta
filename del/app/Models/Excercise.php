<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excercise extends Model
{
    use HasFactory;  
    
    protected $table="excercise";
    protected $fillable = ['category_id', 'goal_id', 'excercise_name', 'position', 'status','note'];
}
