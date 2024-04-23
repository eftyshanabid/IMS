<?php

namespace Modules\Products\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\IMS\app\Models\Supplier;

class ProductSupplier extends Model
{
    use HasFactory;

    protected $table = 'product_suppliers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'product_id',
        'supplier_id',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
