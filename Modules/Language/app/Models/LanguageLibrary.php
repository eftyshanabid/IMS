<?php

namespace Modules\Language\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanguageLibrary extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'language_id',
        'slug',
        'translation',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    function language(){
        return $this->belongsTo(Language::class);
    }

    public function creator(){
        return $this->hasOne(\App\Models\User::class, 'id', 'created_by');
    }

    public function editor(){
        return $this->hasOne(\App\Models\User::class, 'id', 'updated_by');
    }

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(auth()->check()){
                $query->created_by = auth()->user()->id;
            }
        });
        static::updating(function($query){
            if(auth()->check()){
                $query->updated_by = auth()->user()->id;
            }
        });
    }
}
