<x-app-layout>
    <x-slot name="header">
        <script>
            let index = {{ $commande->ligne_commandes->count() }} ;
            //console.log(index);


        let editingRow = null;

        function addProduct() {
            const product = document.getElementById('produit_id').value;
            const quantity = document.getElementById('quantite_id').value;

            if (product && quantity) {
                if (editingRow) {
                    // Mise à jour de la ligne existante
                    editingRow.cells[0].textContent = product;
                    editingRow.cells[1].textContent = quantity;
                    editingRow = null;
                }
                else {
                    // Ajout d'une nouvelle ligne
                    const table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
                    const newRow = table.insertRow();

                    const productCell = newRow.insertCell(0);
                    const quantityCell = newRow.insertCell(1);
                    const actionCell = newRow.insertCell(2);

                    productCell.textContent = product;
                    quantityCell.textContent = quantity;

                    let editBtn=document.getElementById("edit_btn");
                    let deleteBtn=document.getElementById("bt_del");

                    editBtn.onclick = function() {
                     editProduct(newRow);}
                    //console.log(editBtn);

                    deleteBtn.onclick = function() {
                        deleteProduct(newRow);}

                    // const editBtn = document.createElement('button');
                    // editBtn.textContent = 'Éditer';
                    // editBtn.classList.add('action-btn', 'edit-btn');
                    // editBtn.onclick = function() {
                    //     editProduct(newRow);
                    // };

                    // const deleteBtn = document.createElement('button');
                    // deleteBtn.textContent = 'Supprimer';
                    // deleteBtn.classList.add('action-btn', 'delete-btn');
                    // deleteBtn.onclick = function() {
                    //     deleteProduct(newRow);
                    // };

                    // actionCell.appendChild(editBtn);
                    // actionCell.appendChild(deleteBtn);
                }

                document.getElementById('productForm').reset();
            } else {
                alert('Veuillez remplir les deux champs.');
            }
        }

        function editProduct(row) {
            const productCell = row.cells[0].textContent;
            const quantityCell = row.cells[1].textContent;

            document.getElementById('produit_id').value = productCell;
            document.getElementById('quantite_id').value = quantityCell;

            editingRow = row;
        }

        function deleteProduct(row) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet élément?')) {
                row.remove();
            }
        }

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
                                <button  type="button" id="btn_ajout_element" onclick="addProduct()" class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">+</button>
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
                                    <tr id="ligne-commande{{$loop->index+1}}" class="bg-gray-100">
                                        <td class="py-3 px-6">
                                            <input hidden type="text" value="{{ $ligne_commande->id }}" name="ligne_ids[]" id=""/>
                                            <input hidden type="text" value="{{ $ligne_commande->produit_id }}" name="produits_ids[]" id="produit_id"/>
                                            {{-- @dump($loop) --}}
                                            {{ $ligne_commande->produit->libelle }}
                                        </td>
                                        <td class="py-3 px-6">
                                           <input hidden type="text" value="{{ $ligne_commande->quantite }}" name="quantites[]" id="quantite_id">
                                            {{$ligne_commande->quantite }}
                                        </td>

                                        <td class="py-3 px-6">

                                        </td>
                                        <td class="py-3 px-6">

                                            <button   class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md "id="edit_btn">Editer</button>

                                            <button id="bt_del" type="button"  class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>

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
    </div>
</x-app-layout>


