<?php

namespace Modules\Products\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Attribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'attributes';
    protected $guarded = [];

    protected $fillable = [
        'code',
        'name',
        'description',
        'searchable',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function categories()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

    public function products()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

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
