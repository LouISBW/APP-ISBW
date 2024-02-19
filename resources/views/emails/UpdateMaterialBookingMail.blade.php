<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour réservation du : {{ $booking->date_depart }} </title>
</head>
<body>
<p>Le statut de votre réservation de salle est passé sur: <strong>{{ $booking->statut->name }}</strong></p>

<p>Vous pouvez retrouver tous les détails de la réservation en suivant ce lien : <a href="https://dev.isbw.be/material-bookings/{{ $booking->id }}/edit">Réservation</a></p>

<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
<?php
