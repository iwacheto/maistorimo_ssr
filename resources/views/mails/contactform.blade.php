<!DOCTYPE html>
<html>
<head>
   <title>Maistorimo.bg</title>
</head>
<body>
    <h1>Message from  {{ $data['name'] }}</h1>

   <p>Email: {{ $data['email'] }}</p>

    <p>Subject: {{ $data['subject'] }}</p>

    <p>Message: {{ $data['msg'] }}</p>
</body>
</html>
