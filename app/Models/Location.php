<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'locations';
    protected $guarded = [];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Location')
            ->logUnguarded();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} location";
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
