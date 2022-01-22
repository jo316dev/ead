<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{
    use HasFactory, UuidTrait, HasApiTokens;

    public $incrementing = false;
    protected $fillable = ['name', 'description', 'image'], $keyType = 'uuid';


    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
