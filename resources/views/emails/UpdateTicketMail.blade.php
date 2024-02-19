<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre ticket du : {{ $booking->date}} </title>
</head>
<body>
<p>Le statut de votre ticket est passé sur: <strong>{{ $booking->statut->name }}</strong></p>

<p>Vous pouvez retrouver tous les détails du ticket en suivant ce lien : <a href="https://dev.isbw.be/ticketings/{{ $booking->id }}/view">Voir le Ticket</a></p>

<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
<?php
