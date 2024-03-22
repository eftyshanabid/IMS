<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserColumnVisibility extends Model
{
	protected $table = 'user_column_visibilities';
	protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'url',
        'columns',
    ];
    protected $dates = [
        'created_at', 'updated_at'
    ];
}