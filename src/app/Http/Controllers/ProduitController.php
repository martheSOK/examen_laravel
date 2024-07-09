<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $paginate_nuber=5;

        //recherche
        $search_value = $request->input("search");

        if($search_value){

            //si par le non
            ///$produits = Produit::where("libelle","=", $search_value)->paginate($paginate_nuber);

            //produit commencent par quelquechose ou bien filtrer par libelle ou par quantiter ou par prix
            $produits = Produit::where("libelle", "like" ,"%".$search_value."%")
                        ->orWhere("libelle",$search_value)
                        ->orWhere("quantite",$search_value)
                        ->orWhere("prix",$search_value)
                        ->paginate($paginate_nuber);
        }
        else{
            $produits = Produit::paginate($paginate_nuber);
        }

       // dd($produits);
        return view("produits.index",compact("produits"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //str_replace('public/', '', $path)

        $valadate=$request->validate([
            "libelle" => "required|alpha",
            "quantite" => "required|integer",
            "prix" => "required|integer",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images/produits');
        //dd($path);
        Produit::create([
            'libelle' => $request->libelle,
            'quantite' => $request->quantite,
            'prix' => $request->prix,
            'image' => $path,
        ]);
        return redirect()->route('produits.index');






    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
        return view('produits.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
        return view('produits.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        //
        $validate=$request->validate([
            "libelle" => "required|alpha",
            "quantite" => "required|integer",
            "prix" => "required|integer",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $produit->update($validate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
        $produit->delete();
        return redirect()->route('produits.index');
    }
}
