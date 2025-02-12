<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Admin extends Model
{
    use HasApiTokens, HasFactory;

    // Pastikan auto-increment dimatikan agar ID dianggap sebagai string UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'username', 'phone', 'email', 'password'];
    protected $hidden = ['password'];

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
