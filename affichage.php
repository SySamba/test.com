<?php
include('./phpqrcode/phpqrcode/qrlib.php');

$patientId = isset($_GET['id']) ? $_GET['id'] : null;

if ($patientId !== null) {
    $db = new PDO("mysql:host=localhost;dbname=hopital", "root", "");
    $rec = $db->prepare("SELECT * FROM patient WHERE id = ?");
    $rec->execute([$patientId]);

    if ($patient = $rec->fetch(PDO::FETCH_ASSOC)) {
        // Mise en forme des informations du patient
        $nom = $patient['nom'];
        $prenom = $patient['prenom'];
        $groupeSanguin = $patient['groupe_sanguin'];

        // Spécifiez le chemin du dossier où vous souhaitez enregistrer les codes QR
        $qrCodeDirectory = "./image_codeqr/";

        // Génération du code QR avec les informations du patient
        $codeqrData = "Nom: $nom, Prénom: $prenom, Groupe Sanguin: $groupeSanguin";
        $codeqrPath = $qrCodeDirectory . "codeqr_" . $nom . $prenom . ".png";

        // Utilisez la fonction QRcode de la bibliothèque PHP QR Code pour générer le code QR
        QRcode::png($codeqrData, $codeqrPath);

        // Création d'une image avec le groupe sanguin et le code QR
        $image = imagecreatetruecolor(300, 185);
        $background_color = imagecolorallocate($image, 6, 57, 112); // Couleur bleu ciel
        imagefill($image, 0, 0, $background_color);

        // Ajout du code QR à gauche du milieu
        $codeQrImage = imagecreatefrompng($codeqrPath);
        imagecopy($image, $codeQrImage, 50, 15, 0, 0, imagesx($codeQrImage), imagesy($codeQrImage));

        // Ajout du groupe sanguin à droite
        $groupeSanguinColor = imagecolorallocate($image, 224, 222, 220); // Couleur blanche
        imagefilledellipse($image, 260, 100, 74, 74, $groupeSanguinColor);
        imagestring($image, 5, 260 - (strlen($groupeSanguin) * 5), 100 - 5, $groupeSanguin, 0);

        // Ajout du nom et prénom
        $nomPrenomColor = imagecolorallocate($image, 224, 222, 220); // Couleur du texte
        $fontPath = './font/yourfont.ttf'; // Assurez-vous de spécifier le chemin correct
        $fontSize = 16; // Taille de la police
        imagettftext($image, $fontSize, 0, 10, 170, $nomPrenomColor, $fontPath, " $prenom $nom");

        // Enregistrement de l'image combinée
        $combinedImagePath = $qrCodeDirectory . "combined_" . $nom . $prenom . ".png";
        imagepng($image, $combinedImagePath);
        imagedestroy($image);

        // Affichage de l'image combinée
        echo "<div style='text-align: center;'>";
        echo "<img src='" . $combinedImagePath . "' alt='Carte de visite'>";
        echo "</div>";

        // Lien de téléchargement direct de l'image combinée
        echo "<br><br>";
        echo "<a href='" . $combinedImagePath . "' download='carte_visite_$nom$prenom.png' style='text-align: center; text-decoration: none; color: #fff; background-color: #007BFF; padding: 10px; font-size: 20px; border-radius: 5px; margin-top: 20px;'>Télécharger la carte de visite</a>";
    } else {
        echo "Aucune information trouvée pour ce patient.";
    }
} else {
    echo "Aucun identifiant de patient fourni";
}
?>
