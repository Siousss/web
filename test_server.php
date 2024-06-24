<?php
function checkServer($url) {
    // Initialisation de cURL
    $ch = curl_init($url);

    // Options de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);    // Inclure les en-têtes de réponse
    curl_setopt($ch, CURLOPT_NOBODY, true);    // N'inclure que les en-têtes, pas le corps

    // Exécution de la requête
    $response = curl_exec($ch);

    // Vérification des erreurs cURL
    if (curl_errno($ch)) {
        echo 'Erreur cURL: ' . curl_error($ch);
        return false;
    }

    // Récupération du code de statut HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Fermeture de cURL
    curl_close($ch);

    // Vérification du code de statut HTTP
    if ($http_code == 200) {
        return true;
    } else {
        return false;
    }
}

// URL de votre serveur à vérifier
$server_url = "http://localhost:8000";

if (checkServer($server_url)) {
    echo "Le serveur est en route.";
} else {
    echo "Le serveur n'est pas en route.";
}
?>
