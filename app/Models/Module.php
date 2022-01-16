<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $fillable = ['name'], $keyType = 'uuid';


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
