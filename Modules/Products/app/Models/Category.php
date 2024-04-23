<?php

namespace Modules\Products\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Modules\IMS\app\Models\Departments;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $name = 'categories';
    protected $fillable = [
        'code',
        'name',
        'parent_id',
        'description',
    ];

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function department()
    {
        return $this->belongsToMany(Departments::class, 'categories_departments', 'category_id', 'department_id');
    }

    public function departmentsList()
    {
        return $this->hasMany(CategoryDepartment::class, 'category_id', 'id');
    }

    public function relUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            if (Auth::check()) {
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function ($query) {
            if (Auth::check()) {
                $query->updated_by = Auth::user()->id;
            }
        });
    }

}
