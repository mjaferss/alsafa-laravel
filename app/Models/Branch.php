<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Localizable;

class Branch extends Model
{
    use HasFactory, SoftDeletes, Localizable;

    protected $fillable = [
        'name_ar',
        'name_en',
        'address_ar',
        'address_en',
        'phone',
        'email',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the branch name based on current locale
     */
    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
    }

    /**
     * Get the branch address based on current locale
     */
    public function getAddressAttribute()
    {
        return $this->getLocalizedAttribute('address');
    }

    /**
     * Get users associated with this branch
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
