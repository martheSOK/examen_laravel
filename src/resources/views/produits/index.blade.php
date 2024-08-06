<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Liste des produits") }}
                </div>
                <div>
                    <a href="{{ route('produits.create') }}">
                        <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Ajouter</button>
                    </a>
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ route('produits.index') }}" method="GET">
                    <div class="w-full">
                        <input type="text" placeholder="Rechercher" class="w-2/3 rounded-md border border-gray-300" name="search">
                        <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md" >Rechercher</button>
                    </div>
                </form>

                    <table class="w-full text-left">
                        <thead class="text-lg font-semibold bg-gray-300">
                            <th class="py-3 px-6">Image</th>
                            <th class="py-3 px-6">Libelle</th>
                            <th class="py-3 px-6">Prix</th>
                            <th class="py-3 px-6">Quantité</th>
                            <th class="py-3 px-6">Actions</th>
                        </thead>
                        <tbody>
                            @forelse ( $produits as $un_produit )
                                <tr class="bg-gray-100">
                                    <td>
                                        @if($un_produit->image)
                                            <img class="w-20 h-20" src="{{ asset('storage/images/produits/'.$un_produit->image) }}" alt="{{ $un_produit->image }}">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $un_produit->libelle }}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $un_produit->prix }}
                                    </td>
                                    <td class="py-3 px-6">
                                        {{ $un_produit->quantite }}
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('produits.edit',$un_produit) }}">
                                            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Editer</button>
                                        </a>
                                        <a href="{{ route('produits.show',$un_produit) }}">
                                            <button class="bg-yellow-600 hover:bg-yellow-500 text-white text-sm px-3 py-2 rounded-md">Consulter</button>
                                        </a>

                                        <form action="{{ route('produits.destroy',$un_produit) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>
                                        </form>

                                    </td>
                                </tr>
                                @empty
                                    <p class=" text-white ">Accun produit disponible</p>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $produits->links() }}
                    </div>
               </div>
            </div>
        </div>
    </div>

</x-app-layout>

