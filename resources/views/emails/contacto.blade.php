<!DOCTYPE html>
<html>
<head>
    <title>Contacto</title>
</head>
<body>
    <h1>Nuevo mensaje de contacto</h1>
    <p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $data['mensaje'] }}</p>
</body>
</html>
