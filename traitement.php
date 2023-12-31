<?php
if (isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['groupe_sanguin']) && !empty($_POST['groupe_sanguin'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $groupeSanguin = $_POST['groupe_sanguin'];

    // Génération d'un mot de passe de 4 chiffres
    $motDePasse = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

    // Spécifiez le chemin du dossier où vous souhaitez enregistrer les codes QR
    $qrCodeDirectory = "./image_codeqr/";

    // Vérifie si le dossier existe, sinon le crée
    if (!file_exists($qrCodeDirectory) && !is_dir($qrCodeDirectory)) {
        mkdir($qrCodeDirectory, 0755, true);
    }

    // Génération du code QR avec les informations du patient
    $codeqrData = "Nom: $nom, Prénom: $prenom, Groupe Sanguin: $groupeSanguin, Mot de passe: $motDePasse";
    $codeqrPath = $qrCodeDirectory . "codeqr_" . $nom . $prenom . ".png";

    // Utilisez la fonction QRcode de la bibliothèque PHP QR Code pour générer le code QR
    include('./phpqrcode/phpqrcode/qrlib.php');
    QRcode::png($codeqrData, $codeqrPath);

    // Mise à jour de la base de données avec le chemin du code QR et le mot de passe
    $db = new PDO("mysql:host=localhost;dbname=hopital", "root", "");
    $req = $db->prepare("INSERT INTO patient (nom, prenom, groupe_sanguin, carteqr, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
    $res = $req->execute([$nom, $prenom, $groupeSanguin, $codeqrPath, $motDePasse]);

    if ($res) {
        // Afficher une alerte avec le mot de passe généré et rediriger après confirmation
        echo "<script>alert('Veuillez noter votre mot de passe : $motDePasse'); window.location.href = 'affichage.php?id=" . $db->lastInsertId() . "';</script>";
    } else {
        echo "Erreur d'insertion";
    }
} else {
    echo "Veuillez remplir tous les champs";
}
?>
