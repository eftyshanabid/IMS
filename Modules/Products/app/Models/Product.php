<?php

namespace Modules\Products\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\IMS\app\Models\Supplier;
use Modules\IMS\app\Models\Units;
use Modules\Products\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $name = "products";
    protected $fillable = [
        'sku',
        'name',
        'parent_id',
        'category_id',
        'product_group_id',
        'unit_id',
        'unit_price',
        'tax',
        'vat',
        'sales_price',
        'description',
        'status',
        'mode_of_purchase',
    ];

    protected $date = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_suppliers', 'product_id', 'supplier_id');
    }

    public function productGroup()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productUnit()
    {
        return $this->belongsTo(Units::class, 'unit_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('serial', 'asc');
    }
}
