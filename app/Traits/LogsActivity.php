<?php

namespace App\Traits;

use App\Models\Activity;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    protected function logActivity($action)
    {
        Activity::create([
            'user_id' => auth()->id(),
            'description' => $this->getActivityDescription($action),
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id
        ]);
    }

    protected function getActivityDescription($action)
    {
        $modelName = class_basename($this);
        return trans('activity.' . $action, [
            'model' => trans('models.' . strtolower($modelName)),
            'name' => $this->name ?? $this->id
        ]);
    }
}
