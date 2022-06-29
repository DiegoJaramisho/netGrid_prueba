<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_identification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function users ()
    {
        return $this->hasOne(User::class,'type_identifications_id');
    }
}
