<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour réservation de salle du : {{ $booking->date->format('d/m/Y') }} </title>
</head>
<body>
<p>Le statut de votre réservation de salle est passé sur: <strong>{{ $booking->statut->name }}</strong></p>

<p>Vous pouvez retrouver tous les détails de la réservation en suivant ce lien : <a href="https://documents.isbw.be/room-bookings/{{ $booking->id }}/view">Réservation</a></p>


<p>bonne journée</p>
<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
<?php
