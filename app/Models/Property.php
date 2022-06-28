<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class);
    }

    public function salesType()
    {
        return $this->belongsTo(SalesType::class);
    }

    public function buildingType()
    {
        return $this->belongsTo(BuildingType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('add_date');
    }
}
