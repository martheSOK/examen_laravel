console.log(index);

//création des variables

//recupération du noeud du tableau
let tableau_ligne_commandes = document.getElementById("tableau_ligne_commande");

let bouton_ajout_ligne=document.getElementById("btn_ajout_element");
//let bouton_sup_ligne=document.getElementById("btn_sup");
let id_ligne = index;

const produit =document.getElementById('produit_id');
const quantite_element =document.getElementById('quantite_id');

//association de la function ajouterLigneCommande au boutton
bouton_ajout_ligne.addEventListener('click',ajouterLigneCommande);
//bouton_sup_ligne.addEventListener('click',supprimerLigneCommande);

//fonction

function getLigne(produit_id,libelle, quantite) {

    id_ligne +=1;

    return` <tr id="ligne-commande${id_ligne}" class="bg-gray-100">
        <td class="py-3 px-6">
            <input hidden type="text" value="-1" name="ligne_ids[]" id=""/>
            <input hidden type="text" value="${produit_id}" name="produits_ids[]" id="">
            ${libelle}
        </td>
        <td class="py-3 px-6">
         <input hidden type="text" value="${quantite}" name="quantites[]" id="">
            ${quantite}
        </td>

        <td class="py-3 px-6">

        </td>
        <td class="py-3 px-6">

            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Editer</button>

            <button type="button"  class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>

        </td>
    </tr> `;

}


function ajouterLigneCommande() {
    const id_produit=produit.value;
    const libelle=produit.options[produit.selectedIndex].innerText;
    const quantite=quantite_element.value;

    //buttomnlert("buttomnjout de lbuttomn ligne de commbuttomnnde")
    tableau_ligne_commandes.innerHTML +=getLigne(id_produit,libelle,quantite);

    console.log(tableau_ligne_commandes);
    rafraichiretable();
}


function supprimerLigneCommande(id_ligne_tableau) {

   const ligne= document.getElementById(id_ligne_tableau);
    ligne.remove();

}
function editLigneCommande(id_ligne_tableau) {

}

function rafraichiretable() {
    for (let $i = 0; $i < count(tableau_ligne_commandes .children) ; $i++) {
        console.log();

    }


}






