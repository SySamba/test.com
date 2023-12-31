<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Mot de passe à 4 chiffres</title>
    <!-- Ajout de Bootstrap via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('codePatient.jpg') right center fixed;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* Ajuster la largeur du formulaire en fonction de la largeur de l'écran */
            max-width: 400px; /* Largeur maximale du formulaire */
            margin: auto; /* Centrer le formulaire */
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 23px;
        }

        input {
            width: 40px;
            padding: 10px;
            margin: 5px;
            box-sizing: border-box;
            border: 2px solid #bcb3b0; /* Bordure autour des champs de mot de passe */
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
        }

        input[type="password"] {
            width: 40px;
        }

        input[type="submit"] {
            width: 50%;
            padding: 10px;
            background-color: #28a745; /* Couleur du bouton */
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 24px; /* Taille de la police du bouton */
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Couleur au survol */
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <form action="/traitement-du-formulaire" method="post">
            <label for="code">Votre mot de passe </label>
            <br>
            <div>
                <input type="password" id="digit1" name="digit1" maxlength="1" oninput="moveToNext(this)" required>
                <input type="password" id="digit2" name="digit2" maxlength="1" oninput="moveToNext(this)" required>
                <input type="password" id="digit3" name="digit3" maxlength="1" oninput="moveToNext(this)" required>
                <input type="password" id="digit4" name="digit4" maxlength="1" oninput="moveToNext(this)" required>
            </div>
            
            <div class="error-message" id="errorMessage"></div>

            <br>

            <input type="submit" value="Valider" class="btn btn-success">
        </form>
    </div>

    <!-- Ajout de Bootstrap JS et jQuery via CDN (nécessaire pour certains composants Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function moveToNext(input) {
            var errorMessage = document.getElementById('errorMessage');
            errorMessage.innerHTML = "";

            if (!/^\d$/.test(input.value)) {
                errorMessage.innerHTML = "Veuillez entrer uniquement des chiffres.";
                input.value = "";
                return;
            }

            if (input.value.length === 1) {
                var nextInput = input.nextElementSibling;
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }
    </script>
</body>
</html>
