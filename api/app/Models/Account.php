<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = "accounts";

    protected $fillable = ['user_id', 'nom', 'type', 'solde_initial', 'solde_actuel'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
