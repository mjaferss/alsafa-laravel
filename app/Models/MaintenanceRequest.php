<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'branch_id',
        'tower_id',
        'main_section_id',
        'notes',
        'status',
        'subtotal',
        'tax',
        'total',
        'supervisor_id',
        'supervisor_notes',
        'supervisor_action_at',
        'is_active'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'supervisor_approval' => 'boolean',
        'manager_approval' => 'boolean',
        'supervisor_action_at' => 'datetime',
        'manager_action_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * الحالات المتاحة للطلب
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SUPERVISOR_APPROVED = 'supervisor_approved';
    const STATUS_SUPERVISOR_REJECTED = 'supervisor_rejected';
    const STATUS_MANAGER_APPROVED = 'manager_approved';
    const STATUS_MANAGER_REJECTED = 'manager_rejected';

    /**
     * Get the user who created the request
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch associated with the request
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the tower associated with the request
     */
    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    /**
     * Get the main section associated with the request
     */
    public function mainSection()
    {
        return $this->belongsTo(MainSection::class);
    }

    /**
     * Get the items for this maintenance request
     */
    public function items()
    {
        return $this->hasMany(MaintenanceRequestItem::class);
    }

    /**
     * Get the supervisor who handled the request
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Get the manager who handled the request
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * تحديث حالة الطلب بناءً على قرارات المشرف والمدير
     */
    public function updateStatus()
    {
        if ($this->supervisor_approval === false) {
            $this->status = self::STATUS_SUPERVISOR_REJECTED;
        } elseif ($this->supervisor_approval === true && $this->manager_approval === null) {
            $this->status = self::STATUS_SUPERVISOR_APPROVED;
        } elseif ($this->manager_approval === false) {
            $this->status = self::STATUS_MANAGER_REJECTED;
        } elseif ($this->manager_approval === true) {
            $this->status = self::STATUS_MANAGER_APPROVED;
        }

        $this->save();
    }

    /**
     * موافقة المشرف على الطلب
     */
    public function supervisorApprove($notes = null)
    {
        $this->supervisor_approval = true;
        $this->supervisor_notes = $notes;
        $this->supervisor_action_at = now();
        $this->updateStatus();
    }

    /**
     * رفض المشرف للطلب
     */
    public function supervisorReject($notes)
    {
        $this->supervisor_approval = false;
        $this->supervisor_notes = $notes;
        $this->supervisor_action_at = now();
        $this->updateStatus();
    }

    /**
     * موافقة المدير على الطلب
     */
    public function managerApprove($notes = null)
    {
        $this->manager_approval = true;
        $this->manager_notes = $notes;
        $this->manager_action_at = now();
        $this->updateStatus();
    }

    /**
     * رفض المدير للطلب
     */
    public function managerReject($notes)
    {
        $this->manager_approval = false;
        $this->manager_notes = $notes;
        $this->manager_action_at = now();
        $this->updateStatus();
    }

    /**
     * حساب الإجمالي والضريبة
     */
    public function calculateTotals($subtotal, $taxRate = 0.15)
    {
        $this->subtotal = $subtotal;
        $this->tax = $subtotal * $taxRate;
        $this->total = $this->subtotal + $this->tax;
        $this->save();
    }
}
