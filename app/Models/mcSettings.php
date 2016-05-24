<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcSettings extends Model
{
    protected $table = 'mcSettings';
    protected $fillable = ['client_id', 'secret_key', 'access_token', 'admin_email'];
}