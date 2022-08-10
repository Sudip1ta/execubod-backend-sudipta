<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table="user_information";

    protected $fillable = ['user_id', 'height', 'current_weight', 'target_weight', 'chest', 'shoulder', 'waist', 'stomach', 'calves', 'thighs', 'goals', 'experience', 'profile_image_id', 'subscription_status'];
}
