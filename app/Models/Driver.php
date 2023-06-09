<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Driver extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'drivers';
    protected $guarded = ['id'];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Driver')
            ->logUnguarded();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} driver";
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function usageHistories()
    {
        return $this->hasMany(UsageHistory::class);
    }
}
