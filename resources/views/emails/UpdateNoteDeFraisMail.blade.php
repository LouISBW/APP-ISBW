<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre note de frais du : {{ $record->created_at }} </title>
</head>
<body>
<p>Le statut de votre note de frais est passé sur: <strong>{{ $record->statut->name }}</strong></p>

<p>Vous pouvez retrouver tous les  en suivant ce lien : <a href="https://documents.isbw.be/note-de-frais">Voir la note de frais</a></p>

<p>bonne journée</p>
<p>L'équipe <strong>Infocom</strong></p>
</body>
</html>
<?php
