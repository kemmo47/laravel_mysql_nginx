<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    protected $fillable = ['todo_info', 'todo_check', 'todo_complete', 'user_id'];
    protected $table = 'tbl_todos';
    protected $primaryKey = 'todo_id';
    public $timestamps = false;
}
