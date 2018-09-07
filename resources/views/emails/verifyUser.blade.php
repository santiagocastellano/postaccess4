
<!DOCTYPE html>
<html>
<head>
    <title>Email de Bienvenida</title>
</head>
 
<body>
<h2>Bienvenido al sitio {{$user['name']}}</h2>
<br/>
Su email de registracion es {{$user['email']}} , Haga click en el enlace inferior para verificar su cuenta
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Verificar Email</a>
</body>
 
</html>