<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'phone',
        'division_id',
        'position',
        'image',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
