<x-app-layout>
    <x-slot name="header">

    <script>
            let index = {{ $commande->ligne_commandes->count() }} ;
            //console.log(index);


            // function editLigneCommande(index) {
            //     // Récupère les valeurs de la ligne sélectionnée
            //     const produitId = document.getElementById(`produit_id${index}`).value;
            //     const quantite = document.getElementById(`quantite_id${index}`).value;

            //     // Remplir les champs du formulaire avec ces valeurs
            //     document.getElementById('produit_id').value = produitId;
            //     document.getElementById('quantite_id').value = quantite;

            //     // Ajouter un attribut data-index pour savoir quelle ligne est en cours d'édition
            //     document.getElementById('productForm').setAttribute('data-edit-index', index);
            // }



        //     function deleteLigneCommande(index) {
        //         const ligneCommande = document.getElementById(`ligne-commande${index}`);
        //         const montantLigne = parseFloat(ligneCommande.querySelector('.montant-ligne').innerText);

        //         // Supprimer la ligne de la commande
        //         ligneCommande.remove();

        //         // Mettre à jour le montant total
        //         const montantTotalElement = document.getElementById('montant_total');
        //         let montantTotal = parseFloat(montantTotalElement.value) || 0;
        //         montantTotal -= montantLigne;
        //         montantTotalElement.value = montantTotal.toFixed(2);
        //     }

        //     function editLigneCommande(index) {
        //         // Récupère les valeurs de la ligne sélectionnée
        //         const produitId = document.getElementById(`produit_id${index}`).value;
        //         const quantite = document.getElementById(`quantite_id${index}`).value;

        //         // Remplir les champs du formulaire avec ces valeurs
        //         document.getElementById('produit_id').value = produitId;
        //         document.getElementById('quantite_id').value = quantite;

        //         // Ajouter un attribut data-index pour savoir quelle ligne est en cours d'édition
        //         document.getElementById('productForm').setAttribute('data-edit-index', index);
        //     }

        // document.getElementById('btn_ajout_element').addEventListener('click', function() {
        //     // Récupère l'index de la ligne en cours d'édition
        //     const index = document.getElementById('productForm').getAttribute('data-edit-index');

        //     if (index) {
        //         // Récupère les valeurs des champs de produit et quantité
        //         const produitId = document.getElementById('produit_id').value;
        //         const produitLibelle = document.querySelector(`#produit_id option[value="${produitId}"]`).textContent;
        //         const quantite = document.getElementById('quantite_id').value;

        //         // Mettre à jour les valeurs cachées et l'affichage dans le tableau
        //         document.getElementById(`produit_id${index}`).value = produitId;
        //         document.getElementById(`quantite_id${index}`).value = quantite;

        //         const ligneCommande = document.getElementById(`ligne-commande${index}`);
        //         ligneCommande.querySelector('td:nth-child(1)').innerText = produitLibelle;
        //         ligneCommande.querySelector('td:nth-child(2)').innerText = quantite;

        //         // Réinitialiser les champs du formulaire et supprimer l'index d'édition
        //         document.getElementById('productForm').removeAttribute('data-edit-index');
        //         document.getElementById('produit_id').value = '';
        //         document.getElementById('quantite_id').value = '';
        //     } else {
        //         alert("Veuillez sélectionner une ligne à éditer.");
        //     }
        // });


    </script>

        @vite(['resources/js/commande.js'])
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __(" Mettre à jour la commande") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ route('commandes.update' , $commande)}}" method="post" id="productForm" async>
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3  text-white">
                                <label for="client">Client</label>
                                <input type="text" name="client" id="client" value="{{ old('client', $commande->client ?? '') }}"  class="border-gray-300 rounded-md w-full  text-black">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label class="text-white">Montant Total</label>
                                <input type="text" id="montant_total" class="border-gray-300 rounded-md w-full text-black" readonly>
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3 text-black">
                                <label class="text-white" for="produit_id">Produit</label>
                                <select name="produit_id" id="produit_id" class="border-gray-300 rounded-md w-full ">
                                    <option value="">selectionner</option>
                                    @foreach ($produits as $un_produit)
                                        <option value="{{ $un_produit->id }}">{{ $un_produit->libelle }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="space-y-2 w-1/3  ">
                                <label class="text-white" for="">Quantite</label>
                                <input type="number" name="quantite" id="quantite_id" class="border-gray-300 rounded-md w-full  text-black">
                            </div>
                            <div>
                                <button  type="button" id="btn_ajout_element"  class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">+</button>
                            </div>
                        </div>
                        <div class="space-y-3 items-center">
                            <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Enregistrer</button>
                            <table class="w-full text-left"  id="productTable">
                                <thead class="text-lg font-semibold bg-gray-300">
                                    <th class="py-3 px-6">Produit</th>
                                    <th class="py-3 px-6">Quantité</th>
                                    <th class="py-3 px-6">Monant</th>
                                    <th class="py-3 px-6">Actions</th>
                                </thead>
                                <tbody id="tableau_ligne_commande">
                                    @foreach($commande->ligne_commandes as $ligne_commande)
                                        <tr id="ligne-commande{{ $loop->index + 1 }}" class="bg-gray-100">
                                            <td class="py-3 px-6">
                                                <input hidden type="text" value="{{ $ligne_commande->id }}" name="ligne_ids[]" />
                                                <input hidden type="text" value="{{ $ligne_commande->produit_id }}" name="produits_ids[]" id="produit_id{{ $loop->index + 1 }}"/>
                                                {{ $ligne_commande->produit->libelle }}
                                            </td>
                                            <td class="py-3 px-6">
                                                <input hidden type="text" value="{{ $ligne_commande->quantite }}" name="quantites[]" id="quantite_id{{ $loop->index + 1 }}">
                                                {{ $ligne_commande->quantite }}
                                            </td>
                                            <td class="py-3 px-6 montant-ligne">
                                                {{ $ligne_commande->produit->prix * $ligne_commande->quantite }}
                                            </td>
                                            <td class="py-3 px-6">
                                                <button type="button" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md" onclick="editLigneCommande({{ $loop->index + 1 }})">Éditer</button>
                                                <button type="button" class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md" onclick="deleteLigneCommande({{ $loop->index + 1 }})">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


