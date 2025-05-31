<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Localizable;

class MaintenanceDescription extends Model
{
    use HasFactory, Localizable;

    public $timestamps = false;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'main_section_id',
        'created_by',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Get the description based on current locale
     */
    public function getDescriptionAttribute()
    {
        return $this->getLocalizedAttribute('description');
    }

    /**
     * Get the maintenance request items for this description
     */
    public function maintenanceRequestItems()
    {
        return $this->hasMany(MaintenanceRequestItem::class);
    }
}
