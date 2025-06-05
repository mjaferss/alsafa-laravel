<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tower_id',
        'apartment_type_id',
        'name',
        'floor_number',
        'cost',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'floor_number' => 'integer',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the tower that owns the apartment.
     */
    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    /**
     * Get the type of the apartment.
     */
    public function type()
    {
        return $this->belongsTo(ApartmentType::class, 'apartment_type_id');
    }

    /**
     * Get the user who created the apartment.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the apartment.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
