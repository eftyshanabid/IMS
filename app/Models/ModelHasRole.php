<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
	protected $table = "model_has_roles";
	public $fillable = [
		'role_id',
		'model_type',
		'model_id',
	];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(PMSRole::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'model_id');
    }
}
