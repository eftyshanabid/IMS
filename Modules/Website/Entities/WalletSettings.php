<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_wallet';
    protected $fillable = [
        'environment',
        'access_token',
        'application_id',
        'location_id',
        'redirect_url',
        'merchant_support_email',
    ];
}
