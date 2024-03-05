<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Réservation de salle Créé</title>
</head>
<body>
<p>Une nouvelle réservation a été créé par : <strong>{{ $record->user->name }}</strong></p>
<ul>
    <li>Date de la réservation : <strong>{{ $record->date_depart }}</strong></li>
</ul>

<p>Vous pouvez retrouver tous les détails de la réservation en suivant ce lien : <a href="https://documents.isbw.be/service-infocoms/{{ $record->id }}/edit">Réservation</a></p>

<p>bonne journée</p>
<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
