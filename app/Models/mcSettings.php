<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcSettings extends Model
{
    protected $table = 'mcSettings';
    protected $fillable = ['client_id', 'secret_key', 'access_token', 'admin_email', 'scan_depth', 'send_proposal', 'register_deny', 'xmpp', 'xmpp2', 'xmpp3' ];
}
