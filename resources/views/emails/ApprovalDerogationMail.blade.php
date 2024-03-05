<html>
<head>
    <title>Approbation en Attente</title>
</head>
<body>
<p>Bonjour</strong></p>
<p>Une demande de dérogation horaire de {{$record->user->name}}</p>
<p>est en attente de validation.</p>
<ul>
    <li>Date de la réception : <strong>{{ $record->created_at }}</strong></li>
    <li>Statut : <strong>{{ $record->statut->name }}</strong></li>
</ul>

<p>Vous trouverez tous les détails de sur notre plateforme <a href="https://documents.isbw.be/">Approbation</a></p>
<p>bonne journée</p>
<p>L'équipe <strong><a href="mailto:rh@isbw.be">RH</a></strong></p>
</body>
</html>
