<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_vaccine extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'status_vaccine';
}
