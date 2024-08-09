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

    // public  function calculate_amount(): void{

    // }

    protected static function booted(): void
    {
        static::created(function (LigneCommande $lignecommande) {
            $lignecommande->commande->montant +=$lignecommande->quantite*$lignecommande->produit->prix;
            $lignecommande->commande->save();


            $lignecommande->produit->quantite=$lignecommande->produit->quantite-$lignecommande->quantite;
            $lignecommande->produit->save();

        });
        static::updated(function(LigneCommande $lignecommande){

        });
    }
    public function produit():BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
    public function commande():BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }
}
