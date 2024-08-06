\documentclass[11pt,a4paper]{article}
\usepackage[utf8]{inputenc}
{{-- \usepackage[french]{babel} --}}
\usepackage[T1]{fontenc}
\usepackage{amsmath}
\usepackage{amsfonts}
\usepackage{amssymb}
\usepackage{lmodern}
\usepackage[left=2cm,right=2cm,top=2cm,bottom=2cm]{geometry}
\begin{document}
\begin{center}
\begin{LARGE}
\textbf{FACTURE}
\end{LARGE}
\end{center}
\begin{center}
\begin{flushleft}
Date: {{$commande->date}}\\
Nom du client : {{ $commande->client }}
\end{flushleft}
\vspace{0.5cm}
@php
    $montant=0;
@endphp
\begin{tabular}{|p{1.5cm}|p{7cm}|p{3cm}|p{3.5cm}|}
\hline
Quantité & Désignation & Prix Unitaire & Total \\
\hline

@foreach ($commande->ligne_commandes as $lignecommande)
    {{$lignecommande->quantite}} & {{$lignecommande->produit->libelle}} & {{$lignecommande->produit->prix}} FCFA & {{$lignecommande->produit->prix*$lignecommande->quantite}} FCFA\\
    @php
        $montant=$montant+$lignecommande->produit->prix*$lignecommande->quantite;
@endphp
    \hline
@endforeach

\multicolumn{2}{|c|}{Somme total} &  \multicolumn{2}{|c|}{ {{$montant}}  FCFA}\\
\hline
\end{tabular}
\end{center}
\end{document}
