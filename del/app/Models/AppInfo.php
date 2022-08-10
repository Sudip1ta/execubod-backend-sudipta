<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppInfo extends Model
{
    use HasFactory;

    protected $table="app_intro";

    protected $fillable = ['short_description', 'description', 'image_id', 'status'];
}
