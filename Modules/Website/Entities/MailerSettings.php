<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MailerSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_mail';
    protected $fillable = [
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_user_name',
        'mail_user_password',
        'mail_encryption',
        'mail_from_address',
        'mail_name',
    ];
}
