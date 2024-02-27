<!DOCTYPE html>
<html>
<head>
    <title>Confirmation réception dérogation horaire</title>
</head>
<body>
<p>Bonjour {{ $record->user->name }}</strong></p>
<p>Nous avons bien reçu ta demande de dérogation horaire, </p>
<p>sa validation est en attente.</p>
<ul>
    <li>Date de la réception : <strong>{{ $record->created_at }}</strong></li>
    <li>Période concernée : <strong>{{ $record->month }}</strong></li>
</ul>

<p>Pour toutes demandes de modifications veuillez passer par l'adresse mail <a href="mailto:rh@isbw.be">rh@isbw.be</a> </p>

<p>bonne journée</p>

<p>L'équipe <strong><a href="mailto:rh@isbw.be">RH</a></strong></p>
</body>
</html>
