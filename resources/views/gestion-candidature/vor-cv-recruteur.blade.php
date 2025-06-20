<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cv</title>
</head>
<style>
    body{
        height: 100vh;
    }
    body embed{
        width: 100%;
        height: 100%;
    }
</style>
<body>
       <iframe src="{{ asset('storage/' . $cv_utilisateur) }}" type="application/pdf" width="100%" height="100%" ></iframe>
</body>
</html>
