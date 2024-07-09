<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LigneCommande extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantite',
        'produit_id',
        'commande_id',

    ];
    public function produit():BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
    public function commande():BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }
}
