<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Order')
            ->logUnguarded();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} order";
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(Approval::class, 'approver_id', 'id');
    }
    public function approver2()
    {
        return $this->belongsTo(Approval::class, 'approver2_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(Location::class, 'from_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id', 'id');
    }
}
