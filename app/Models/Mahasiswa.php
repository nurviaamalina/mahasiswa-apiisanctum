<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama','nim','jurusan'];
}