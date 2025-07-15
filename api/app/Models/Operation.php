<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $tabme = "operations";

    protected $fillable = ['account_id', 'type', 'nom', 'montant', 'categorie_id', 'date', 'note'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function subscriptionLog()
    {
        return $this->hasOne(SubscriptionOperationLog::class);
    }
}
