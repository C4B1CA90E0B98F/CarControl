<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Approval extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'approvals';
    protected $guarded = ['id'];

    protected static $logAttributes = ['name', 'phone_number', 'address', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Approval')
            ->logOnly(['name', 'phone_number', 'address', 'status']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} approval";
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'approver_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
