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
            "libelle" => "required|string|unique:produits",
            "quantite" => "required|integer",
            "prix" => "required|integer",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //recupération de l'image du input
        $path = $request->file('image');
        //renomage de l'image
        $id=Produit::max("id")+1;
        $ext= $path->getClientOriginalExtension();
        $nom_image=strtolower($request->libelle."_".$id.".".$ext);
        //storeAs permet de renomer le non de l'image dont on veut sauvegarder en locale dans un dossier images/produit
        $image_produit=$path->storeAs('images/produits',$nom_image);

        //dd($path);
        // Produit::create([
        //     'libelle' => $request->libelle,
        //     'quantite' => $request->quantite,
        //     'prix' => $request->prix,
        //     'image' => $image_produit,
        // ]);

        //$data=$request->all();
        //changer le chemin de l'image
        $valadate["image"]=$nom_image;

        Produit::create($valadate);
        return redirect()->route('produits.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
        return view('produits.edit', compact("produit"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        //
        $validate=$request->validate([
            "libelle" => "required",
            "quantite" => "required|integer",
            "prix" => "required|integer",
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //recupération de l'image du input
        $path = $request->file('image');

        if($path!=null){
            //renomage de l'image
        $id=$produit->id;
        $ext= $path->getClientOriginalExtension();
        $nom_image=strtolower($request->libelle."_".$id.".".$ext);
        //storeAs permet de renomer le non de l'image dont on veut sauvegarder en locale dans un dossier images/produit
        $image_produit=$path->storeAs('images/produits',$nom_image);


        //changer le chemin de l'image
        $valadate["image"]=$image_produit;

        }

        $produit->update($validate);
        return redirect()->route('produits.index');

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
