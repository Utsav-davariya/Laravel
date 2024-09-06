<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome single BC....!</title>
</head>
<body>
<h1>SINGLE USER DATA</h1>

@foreach ($data as $user)
<h3>
  <h1>id:   {{$user->id}}|</h1>
  <h1>name: {{$user->name}}|</h1>
  <h1>email:   {{$user->email}}|</h1>


</h3>
@endforeach
</body>
</html>
