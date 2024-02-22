<!DOCTYPE html>
<html>
<head>
    <title>Confirmation réception Note de Frais</title>
</head>
<body>
<p>Bonjour {{ $record->user->name }}</strong></p>
<p>Nous avons bien reçu ta demande de remboursement de frais, </p>
<p>sa validation est en attente.</p>
<ul>
    <li>Date de la réception : <strong>{{ $record->created_at }}</strong></li>
    <li>Période concernée : <strong>{{ $record->month }}</strong></li>
    <li>Type de Note de Frais : <strong>{{ $record->type_nfs->name }}</strong></li>
    <li>Montant : <strong>{{ $record->montant }}€</strong></li>
    <li>Statut : <strong>{{ $record->statut->name }}</strong></li>
</ul>

<p>bonne journée</p>
<p>L'équipe <strong><a href="mailto:comptabilite@isbw.be">Pôle Budget et Finances</a></strong></p>
</body>
</html>
