<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['user_name', 'user_email', 'user_password'];
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
