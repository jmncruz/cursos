<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'img_path',
        'courses',
    ];
    public function addresses(){
        return $this->hasOne(Addresses::class, 'students_id');
    }

}
