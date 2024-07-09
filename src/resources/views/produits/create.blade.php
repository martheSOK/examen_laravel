<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ajouter un nouveau produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ route('produits.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label  class=" text-white " for="libelle">Libelle</label>
                                <input type="text" name="libelle" id="libelle" class="border-gray-300 rounded-md w-full">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label  class=" text-white " for="quantite">Prix</label>
                                <input type="number" name="quantite" id="quantite" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label  class=" text-white " for="prix">Quantité</label>
                                <input type="number" name="prix" id="prix" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label  class=" text-white " for="image">Image</label>
                                <input type="file" name="image" id="image" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>

                    <div>
                        <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                            Ajouter
                        </button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>


