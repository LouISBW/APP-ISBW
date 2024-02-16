<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour réservation de salle du : {{ $record->date->format('d/m/Y') }} </title>
</head>
<body>
<p>Le statut de votre réservation de salle est passé sur: <strong>{{ $record->statut->name }}</strong></p>

<p>Vous pouvez retrouver tous les détails de la réservation en suivant ce lien : <a href="https://isbwapp.test/room-bookings/{{ $record->id }}/view">Réservation</a></p>

<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
<?php
