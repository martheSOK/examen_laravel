<x-app-layout>
    <x-slot name="header">
        @vite(['resources/js/commande.js'])
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ajouter une nouvelle commande") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ route('commandes.store')}}" method="post" async>
                    @csrf
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3  text-white">
                                <label for="client">Client</label>
                                <input type="text" name="client" id="client" class="border-gray-300 rounded-md w-full  text-black">
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
                                <button  type="button" id="btn_ajout_element" class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">+</button>
                            </div>
                        </div>
                        <div class="space-y-3 items-center">
                            <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Enregistrer</button>
                            <table class="w-full text-left">
                                <thead class="text-lg font-semibold bg-gray-300">
                                    <th class="py-3 px-6">Produit</th>
                                    <th class="py-3 px-6">Quantité</th>
                                    <th class="py-3 px-6">Monant</th>
                                    <th class="py-3 px-6">Actions</th>
                                </thead>
                                <tbody id="tableau_ligne_commande">

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


