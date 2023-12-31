<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>l'ajout d'un Patient</title>
    <!-- Ajout de Bootstrap via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            align-items: center;
            height: 100vh;
        }

        .background-image {
            background: url('imagePatient.jpg') right center fixed;
            background-size: cover;
            width: 50%; /* Ajustez la largeur de l'image selon vos besoins */
            height: 100%;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%; /* Ajustez la largeur du formulaire selon vos besoins */
            float: left;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            background-color:#439cd1;
            padding: 10px; /* Ajout de rembourrage pour une meilleure apparence */
            margin-left: 50px;
            margin-right: 50px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 40%;
            padding: 10px;
            background-color: rgb(37, 150, 190);
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 180px;
            margin-left: 140px;
            transition: background-color 0.3s; /* Ajout de l'effet de transition */
        }

        button:hover {
            background-color: rgb(37, 120, 150);
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="background-image"></div>
        
        <form action="traitement.php" method="post">
            <h1>L'ajout d'un Patient</h1>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control" required>

            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" required>
            <div class="error-message" id="telephone-error-message"></div>

            <label for="groupe_sanguin">Groupe Sanguin :</label>
            <select id="groupe_sanguin" name="groupe_sanguin" class="form-control" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            <br>

            <button type="submit" class="btn btn-success" style="font-size :40px;">Ajouter</button>
        </form>
    </div>

    <!-- Ajout de Bootstrap JS et jQuery via CDN (nécessaire pour certains composants Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('telephone').addEventListener('input', function (e) {
            var inputValue = e.data;
            var errorMessage = document.getElementById('telephone-error-message');

            if (!/^\d$|\+$/.test(inputValue)) {
                e.target.value = inputValue.slice(0, -1); // Supprime le dernier caractère non autorisé
                errorMessage.innerHTML = "Veuillez entrer uniquement des chiffres ou le signe '+' dans le numéro de téléphone.";
            } else {
                errorMessage.innerHTML = "";
            }
        });
    </script>
</body>
</html>
