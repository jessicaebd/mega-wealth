<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function properties() {
        return $this->hasMany(Property::class);
    }

    // ga jadi dipakai, misal pas perbandingan, harus == 'Rent', gabisa =='rent'
    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
