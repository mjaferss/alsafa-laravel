<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_request_id',
        'maintenance_description_id',
        'quantity',
        'unit_price',
        'has_tax',
        'tax_amount',
        'subtotal',
        'total'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'has_tax' => 'boolean',
        'tax_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    /**
     * Get the maintenance request that owns this item
     */
    public function maintenanceRequest()
    {
        return $this->belongsTo(MaintenanceRequest::class);
    }

    /**
     * Get the description for this item
     */
    public function description()
    {
        return $this->belongsTo(MaintenanceDescription::class, 'maintenance_description_id');
    }

    /**
     * حساب المبالغ للبند
     */
    public function calculateAmounts()
    {
        $this->subtotal = $this->quantity * $this->unit_price;
        
        // حساب الضريبة إذا كان البند خاضع للضريبة والضريبة مفعلة في النظام
        if ($this->has_tax && config('settings.tax.enabled')) {
            $this->tax_amount = $this->subtotal * config('settings.tax.rate', 0.15);
        } else {
            $this->tax_amount = 0;
        }
        
        $this->total = $this->subtotal + $this->tax_amount;
        $this->save();

        // تحديث إجماليات طلب الصيانة
        $this->updateMaintenanceRequestTotals();
    }

    /**
     * تحديث إجماليات طلب الصيانة
     */
    protected function updateMaintenanceRequestTotals()
    {
        $request = $this->maintenanceRequest;
        $items = $request->items;

        $subtotal = $items->sum('subtotal');
        $tax = $items->sum('tax_amount');
        $total = $items->sum('total');

        $request->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }
}
