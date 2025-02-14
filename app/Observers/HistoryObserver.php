<?php

namespace App\Observers;

use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryObserver
{
    /**
     * Handle the Model "created" event.
     */
    public function created($model): void
    {
        $this->saveHistory($model, __FUNCTION__);
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated($model): void
    {
        $this->saveHistory($model, __FUNCTION__);
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted($model): void
    {
        $this->saveHistory($model, __FUNCTION__);
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored($model): void
    {
        $this->saveHistory($model, __FUNCTION__);
    }

    /**
     * Handle the Model "force deleted" event.
     */
    public function forceDeleted($model): void
    {
        $this->saveHistory($model, __FUNCTION__);
    }

    public function saveHistory($model, $event)
    {
        return $model->morphMany(History::class, 'model')->create([
            'message'       => $event,
            'changes'       => $model->getModelChanges(),
            'user_id'       => static::getUserId(),
            'ip_address'    => static::getIp(),
            'user_agent'    => request()->userAgent(),
        ]);
    }

    public static function getUserId()
    {
        return Auth::getDefaultDriver() === 'sanctum'
            ? (request()->user()->id ?? null)
            : Auth::id() ?? null;
    }

    public static function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
        {
            if (array_key_exists($key, $_SERVER) === true)
            {
                foreach (explode(',', $_SERVER[$key]) as $ip)
                {
                    $ip = trim($ip); // just to be safe

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                    {
                        return $ip;
                    }
                }
            }
        }

        return request()->ip();
    }
}
