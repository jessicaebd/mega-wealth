<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $incrementing = false;

    public function propertyStatus() {
        return $this->belongsTo(PropertyStatus::class);
    }

    public function salesType() {
        return $this->belongsTo(SalesType::class);
    }

    public function buildingType() {
        return $this->belongsTo(BuildingType::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)
            ->withPivot('add_date');
    }
}
