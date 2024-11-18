<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
</head>
<body>
    <h1>QR Code généré {{ $qrcode->author }}</h1>
   

    <div>
        <h3>QR Code :</h3>
      {{$qrcode}}
    </div>

    <a href="{{ route('qrcodes.index') }}">Retour à la liste des QR codes</a>
</body>
</html>
