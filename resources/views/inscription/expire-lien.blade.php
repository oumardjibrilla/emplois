<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lien expiré</title>
    <style>
        /* Reset basique */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #d9534f;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 400px;
        }

        a {
            display: inline-block;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }

        a:hover,
        a:focus {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
        }

        /* Responsive : taille plus petite sur mobile */
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
                max-width: 90%;
            }
            a {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Lien expiré</h1>
    <p>Le lien de vérification a expiré. Merci de refaire une nouvelle inscription pour recevoir un nouveau lien.</p>
    <a href="{{route('inscription') }}" aria-label="Retour à la page d'inscription">Retour à la page d'inscription</a>
</body>
</html>
