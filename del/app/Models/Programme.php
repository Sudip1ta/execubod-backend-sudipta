<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $table="workout_program";

    protected $fillable = ['category_id', 'goal_id', 'title', 'description', 'days', 'food_perefence', 'main_goal', 'level', 'avg_days', 'avg_workout_time_per_day', 'status', 'free_days', 'cost', 'total_duration','weeks'];
}
