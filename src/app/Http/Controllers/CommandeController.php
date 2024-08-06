<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ismaelw\LaraTeX\LaraTeX;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function generer_facture(Commande $commande){
    //     return (new LaraTeX('latex.facture'))->with([
    //        "commande" => $commande
    //     ])->download('facture.pdf');

    // }
    public function generer_facture(Commande $commande){
        return (new LaraTeX('latex.facture'))->with(["commande" => $commande])->download("facture_".$commande->client."_".$commande->date.".pdf");
    }

    public function index()
    {
        //
        $commandes=Commande::all();
        //dd($commandes);
        return view('commandes.index', compact("commandes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $produits=Produit::all();
        return view('commandes.create', compact("produits"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        //dd($request->all());

        $client=$request->input("client");

        $vendeur=Auth::user();

        $produit_ids =$request->input("produits_ids");
        $quantites =$request->input("quantites");

        $commande=commande::create([
            "client" =>$client,
            "vendeur_id" =>$vendeur->id,
        ]);

        for ($i=0; $i < count($produit_ids); $i++) {

            // dump($quantites);
            // dd($produit_ids);

            $produit_id=$produit_ids[$i];
            $quantite=$quantites[$i];

            LigneCommande::create([
                "produit_id" =>$produit_id,
                "quantite" =>$quantite,
                "commande_id"=>$commande->id
            ]);

        }
        return redirect()->route('commandes.index');








    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //

        $produits=Produit::all();
        return view('commandes.show', ["produits" => $produits, "commande" => $commande]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
        $produits=Produit::all();
        return view('commandes.edit', ["produits" => $produits, "commande" => $commande]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
        $commande->delete();
        return redirect()->route('commandes.index');
    }
}
