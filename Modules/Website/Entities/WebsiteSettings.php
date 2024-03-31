<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_website';
    protected $fillable = [
        'name',
        'slogan',
        'logo',
        'default_user_logo',
        'favicon',
        'default_user_cover',
        'fee_like_qty',
        'official_email',
        'membership_email',
        'agreement_email',
        'official_phone',
        'official_address',
        'monthly_plan_features',
        'service_agreements',
        'business_structures',
        'tax_filing_statuses'
    ];

}
