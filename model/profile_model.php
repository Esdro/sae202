<?php

require_once "conf/conf.inc.php";

function createUserProfile(int $userId, mixed $data)
{
    global $dbInstance;

    // user_id	nom	prenom	email	date_naissance	tel	adresse_rue	adresse_ville	adresse_cp	


    $query = "INSERT INTO profiles (user_id, nom, prenom, email, date_naissance, tel, adresse_rue, adresse_ville, adresse_cp) 
              VALUES (:user_id, :nom, :prenom, :email, :date_naissance, :tel, :adresse_rue, :adresse_ville, :adresse_cp)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':prenom', $data['prenom']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':date_naissance', $data['date_naissance']);
    $stmt->bindParam(':tel', $data['tel']);
    $stmt->bindParam(':adresse_rue', $data['adresse_rue']);
    $stmt->bindParam(':adresse_ville', $data['adresse_ville']);
    $stmt->bindParam(':adresse_cp', $data['adresse_cp']);
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Profil créé avec succès.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la création du profil.'];
    }
}

function updateUserProfile(int $userId, mixed $data): array
{
    global $dbInstance;

    // Mettre à jour le profil de l'utilisateur
    $query = "UPDATE profiles SET nom = :nom, prenom = :prenom, email = :email, date_naissance = :date_naissance, tel = :tel, adresse_rue = :adresse_rue, adresse_ville = :adresse_ville, adresse_cp = :adresse_cp WHERE user_id = :user_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':prenom', $data['prenom']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':date_naissance', $data['date_naissance']);
    $stmt->bindParam(':tel', $data['tel']);
    $stmt->bindParam(':adresse_rue', $data['adresse_rue']);
    $stmt->bindParam(':adresse_ville', $data['adresse_ville']);
    $stmt->bindParam(':adresse_cp', $data['adresse_cp']);

    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Profil mis à jour avec succès.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de la mise à jour du profil.'];
    }
}

function getUserProfile(int $userId): ?array
{
    global $dbInstance;

    $user = getUserById($userId);
    if (!$user) {
        return null; // L'utilisateur n'existe pas
    }

    // Récupérer le profil de l'utilisateur
    $query = "SELECT * FROM profiles WHERE user_id = :user_id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $profile = $stmt->fetch();

        // Ajouter les informations de l'utilisateur au profil
        $profile['username'] = $user['username'];
        $profile['email'] = $user['email'];
        $profile['created_at'] = $user['created_at'];
        $profile['last_connexion'] = $user['last_connexion'];
        $profile['role'] = $user['role'];
        
        // Formater les dates
        $profile['created_at'] = date('d/m/Y', strtotime($profile['created_at']));
        $profile['last_connexion'] = date('d/m/Y H:i', strtotime($profile['last_connexion']));
        $profile['role'] = ucfirst($profile['role']);

        return $profile; // Retourner le profil complet
    }

    return null; // Aucun profil trouvé pour cet utilisateur
}
