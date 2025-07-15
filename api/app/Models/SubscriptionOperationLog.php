<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionOperationLog extends Model
{
    use HasFactory;

    protected $table = "subscription_operation_logs";

    protected $fillable = ['subscription_id', 'operation_id', 'date_execution'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
}
