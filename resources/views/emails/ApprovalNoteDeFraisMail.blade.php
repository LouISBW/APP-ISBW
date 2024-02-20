<!DOCTYPE html>
<html>
<head>
    <title>Approbation en Attente</title>
</head>
<body>
<p>Bonjour</strong></p>
<p>Une note de frais de {{$record->user->name}}</p>
<p>est en attente de validation.</p>
<ul>
    <li>Date de la réception : <strong>{{ $record->created_at }}</strong></li>
    <li>Période concernée : <strong>{{ $record->month }}</strong></li>
    <li>Type de Note de Frais : <strong>{{ $record->type_nfs->name }}</strong></li>
    <li>Montant : <strong>{{ $record->montant }}€</strong></li>
    <li>Statut : <strong>{{ $record->statut->name }}</strong></li>
</ul>

<p>Vous trouverez tous les détails de la note de frais sur notre plateforme .......</p>

<p>L'équipe <strong><a href="mailto:comptabilite@isbw.be">BFI</a></strong></p>
</body>
</html>
