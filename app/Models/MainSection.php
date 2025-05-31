<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Localizable;

class MainSection extends Model
{
    use HasFactory, SoftDeletes, Localizable;

    protected $fillable = [
        'name_ar',
        'name_en',
        'cost',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the section name based on current locale
     */
    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
    }

    /**
     * Get the user who created the section
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the section
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
