<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table="admins";

    protected $fillable = ['first_name', 'last_name', 'gender', 'dob', 'email', 'password', 'admin_type', 'status', ];
}
