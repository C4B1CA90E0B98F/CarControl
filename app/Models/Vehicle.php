<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Vehicle extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'vehicles';
    protected $guarded = ['id'];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Vehicle')
            ->logUnguarded();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} vehicle";
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
