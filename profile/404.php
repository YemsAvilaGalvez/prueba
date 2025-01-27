<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logo_circular.png" rel="icon" />
    <link href="assets/img/logo/logo_circular.png" rel="apple-touch-icon" />
    <title>Error 404</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Gilda+Display');

        body {
            background-color: black;
            color: white;
            font-family: 'Gilda Display', serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .error {
            font-size: 100px;
            font-family: 'OCR-A', monospace;
            animation: noise-1 1s linear infinite;
        }

        .info {
            font-size: 20px;
            margin-top: 20px;
        }

        .buttons {
            margin-top: 30px;
        }

        .buttons a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            color: white;
            text-decoration: none;
            border: 2px solid white;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .buttons a:hover {
            background-color: white;
            color: black;
        }

        @keyframes noise-1 {
            0%, 20%, 40%, 60%, 70%, 90% { opacity: 0; }
            10% { opacity: .1; }
            50% { opacity: .5; }
            80% { opacity: .3; }
            100% { opacity: .6; }
        }

        @media (max-width: 768px) {
            .error {
                font-size: 60px;
            }

            .info {
                font-size: 16px;
            }

            .buttons a {
                padding: 8px 15px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .error {
                font-size: 40px;
            }

            .info {
                font-size: 14px;
            }

            .buttons a {
                padding: 5px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="error">Error 404</div>
    <div class="info">Archivo no Encontrado</div>
    <div class="buttons">
        <a href="../index.php">Volver al Inicio</a>
        <a href="https://api.whatsapp.com/send?phone=51944395871&text=Buenos%20dias%2C%20no%20encuentro%20mi%20pagina.%0ANecesito%20una%20solucion%2C%20gracias." target="_blank">Contactar al Administrador</a>
    </div>

</body>
</html>
