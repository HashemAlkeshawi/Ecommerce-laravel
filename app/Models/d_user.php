<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class d_user extends Model
{
    use SoftDeletes;
    use HasFactory;

   
    protected $fillable = ['username','email', 'first_name','last_name', 'is_admin', 'password', 'is_active'];

}
