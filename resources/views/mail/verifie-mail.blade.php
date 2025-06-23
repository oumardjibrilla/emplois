<!DOCTYPE html>
<html>
<head>
  <style>
    .btn {
      background-color: rgb(0, 0, 0 ,0.1);
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 700;
      font-size: 18px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <p>Bonjour,</p>
  <p>Nous avons reçu votre demande d’inscription. Pour activer votre compte, cliquez sur le bouton ci-dessous :</p>
  <p><a href="{{$verificationUrl}}" class="btn">Confirmer mon adresse e-mail</a></p>
  <p>Si ce n’est pas vous, veuillez ignorer cet e-mail.</p>
  <p>Cordialement,<br>L’équipe [Nom de l’entreprise]</p>
</body>
</html>
