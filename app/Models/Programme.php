<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Programme extends Model
{
    use HasFactory;

    protected $table="workout_program";

    protected $fillable = ['category_id','goal_id','title','main_goal','description','level','weeks','avg_days','avg_workout_time_per_day','total_duration','free_days','cost','food_perefence','status'];
}
