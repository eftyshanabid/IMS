<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMediaSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_social_media';
    protected $fillable = [
        'twitter',
        'facebook',
        'telegram',
        'discord',
        'youtube',
        'vimeo',
        'tiktok',
    ];
}
