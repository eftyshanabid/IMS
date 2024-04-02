<?php

namespace Modules\CMS\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\CMS\Database\factories\ServicesFactory;

class Services extends Model
{
    use HasFactory;
    
    protected $table = 'services';
    protected $fillable = [
        'title',
        'slug',
        'price',
        'type',
        'status',
    ];

    function plans(){
        return $this->hasMany(\Modules\Plan\app\Models\PlanService::class);
    }

    function subscriptionPlanServices(){
        return $this->hasMany(\Modules\Subscriber\app\Models\SubscriptionPlanService::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            if (Auth::check()) {
                $query->created_by = @\Auth::user()->id;
            }
            $bytes = random_bytes(8);
            $query->slug = bin2hex($bytes);
        });
        static::updating(function ($query) {
            if (Auth::check()) {
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }
}
