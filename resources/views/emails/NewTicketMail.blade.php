<!DOCTYPE html>
<html>
<head>
    <title>Nouveau Ticket ouvert</title>
</head>
<body>
<p>Un nouveau ticket a été créé par : <strong>{{ $record->user->name }}</strong></p>
<ul>
    <li>Date : <strong>{{ $record->date_creation }}</strong></li>
    <li>Type : <strong>{{ $record->type_demande }}</strong></li>
    <li>Sujet : <strong>{{ $record->subject }}</strong></li>

</ul>

<p>Vous pouvez retrouver tous les détails du ticket en suivant ce lien : <a href="https://dev.isbw.be/service-ticketings/{{ $record->id }}/edit">Voir le Ticket</a></p>

<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
