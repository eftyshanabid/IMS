<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'avatar',
        'bio',
        'company_name',
        'location',
        'website',
        'type',
    ];

    protected static $logAttributes = ['name', 'email', 'phone', 'bio', 'company_name', 'location', 'website'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->remember_token = md5(Str::random(10));
        });
    }

    function businessInformation(){
        return $this->hasOne(\Modules\Subscriber\app\Models\BusinessInformation::class, 'user_id', 'id');
    }

    function subscriptions(){
        return $this->hasMany(\Modules\Subscriber\app\Models\Subscription::class);
    }

    function reportRequests(){
        return $this->hasMany(\Modules\Report\app\Models\ReportRequest::class);
    }

    function reports(){
        return $this->hasMany(\Modules\Report\app\Models\Report::class);
    }
}
