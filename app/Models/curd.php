<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curd extends Model
{
    use HasFactory;

    protected $table = 'curd';

    protected $fillable = ['name', 'email', 'city', 'language', 'gender','photo','message'];
}


