<?php

namespace Modules\IMS\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Modules\IMS\Database\factories\CustomerFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */

    protected $table ='customers';
    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'mobile_no',
        'tin',
        'trade',
        'bin',
        'vat',
        'website',
        'agreement',
        'term_conditions',
        'address',
        'status',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            if (Auth::check()) {
                $query->created_by = @\Auth::user()->id;
            }
        });
        static::updating(function ($query) {
            if (Auth::check()) {
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }
}
