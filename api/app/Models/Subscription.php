<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = "subscriptions";

    protected $fillable = [
        'user_id',
        'nom',
        'montant',
        'logo',
        'frequence',
        'date_prelevement',
        'account_id',
        'categorie_id',
        'is_automatique',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function logs()
    {
        return $this->hasMany(SubscriptionOperationLog::class);
    }
}
