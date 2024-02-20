<!DOCTYPE html>
<html>
<head>
    <title>Confirmation réception Note de Frais</title>
</head>
<body>
<p>Bonjour {{ $record->user->name }}</strong></p>
<p>La responsable de vos approbation a bien reçu la note de frais</p>
<p>et sa validation est en attente.</p>
<ul>
    <li>Date de la réception : <strong>{{ $record->created_at }}</strong></li>
    <li>Période concernée : <strong>{{ $record->month }}</strong></li>
    <li>Type de Note de Frais : <strong>{{ $record->type_nfs->name }}</strong></li>
    <li>Montant : <strong>{{ $record->montant }}€</strong></li>
    <li>Statut : <strong>{{ $record->statut->name }}</strong></li>
</ul>

<p>L'équipe <strong><a href="mailto:comptabilite@isbw.be">BFI</a></strong></p>
</body>
</html>
