<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Réservation de salle Créé</title>
</head>
<body>
<p>Une nouvelle réservation de salle a été créé par : <strong>{{ $record->user->name }}</strong></p>
<ul>
    <li>Date de la réservation : <strong>{{ $record->date->format('d/m/Y') }}</strong></li>
    <li>Heure de début : <strong>{{ $record->heure_debut->format('H:i') }}</strong></li>
    <li>Heure de fin : <strong>{{ $record->heure_fin->format('H:i') }}</strong></li>
</ul>

<p>Vous pouvez retrouver tous les détails de la réservation en suivant ce lien : <a href="https://isbwapp.test/secretariat-directions/{{ $record->id }}/edit">Réservation</a></p>

<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
