<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'icone'];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
