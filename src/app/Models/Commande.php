<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'client',
        'montant',
        'date',
        'vendeur_id',
    ];



    public function ligne_commandes():HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    // public function client():BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function vendeur():BelongsTo
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    protected function casts(): array
    {
        return [
            'date' => 'datetime',

        ];
    }

}
