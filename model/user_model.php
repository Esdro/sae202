<?php


require_once "conf/conf.inc.php";
require_once $GLOBALS['model_dir'] . "profile_model.php";


function userExists(string $username): bool
{
    global $dbInstance;
    // Vérifier si l'utilisateur existe déjà dans la base de données
    $query = "SELECT COUNT(*) FROM users WHERE username = :username OR email = :username";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}



function create_user(string $username, string $password, string $email, ?string $role): array
{
    global $dbInstance;


    // Vérifier si l'utilisateur existe déjà
    if (userExists($username)) {
        return ['success' => false, 'message' => 'Cet username existe déjà. Impossible de le réutiiliser.'];
    }
    // Vérifier si l'email existe déjà

    if (userExists($email)) {
        return ['success' => false, 'message' => 'L\'utilisateur avec cet email existe déjà.'];
    }

    if (empty($username) || empty($password) || empty($email)) {
        return ['success' => false, 'message' => 'Tous les champs sont requis.'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Adresse e-mail invalide.'];
    }
    // Si le rôle n'est pas spécifié, on peut définir un rôle par défaut
    if (empty($role)) {
        $role = 'user';
    }


    global $possibleAdminUsers;
    // vérifier si l'email comence selon un jeu de mots définis dans un array
    $email = strtolower($email); // Convertir l'email en minuscules pour la comparaison
    $validEmailPrefixes = $possibleAdminUsers; // Ajouter les préfixes valides ici
    $emailPrefix = explode('@', $email)[0]; // Extraire le préfixe de l'email
    if (!in_array($emailPrefix, $validEmailPrefixes)) {
        $role = 'user'; // Si le préfixe n'est pas valide, attribuer le rôle 'user'
    } else {
        $role = 'admin'; // Si le préfixe est valide, attribuer le rôle 'admin'
    }


    // Hacher le mot de passe pour le stockage sécurisé
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  $date = date('Y-m-d H:i:s');
    // Enregistrer l'utilisateur dans la base de données
    $query = "INSERT INTO users (username, email, password, role, valid_admin, created_at) VALUES (:username, :email, :pwd, :role, 0, :created_at)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pwd', $hashedPassword);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':created_at', $date);

    if ($stmt->execute()) {


        // Si l'utilisateur a été créé avec succès, on peut créer un profil vide
        $userId = $dbInstance->lastInsertId();
        $profileData = [
            'user_id' => $userId,
            'nom' => '',
            'prenom' => '',
            'email' => $email,
            'date_naissance' => null,
            'tel' => '',
            'adresse_rue' => '',
            'adresse_ville' => '',
            'adresse_cp' => ''
        ];

        // Créer le profil de l'utilisateur
        $profileResponse = createUserProfile($userId, $profileData);

        if (!$profileResponse['success']) {
            // Si la création du profil échoue, on peut supprimer l'utilisateur
            deleteUser($userId);
            return ['success' => false, 'message' => $profileResponse['message']];
        }

        // si l'email est administratif, on peut créer un token d'invitation
        if (in_array($emailPrefix, $validEmailPrefixes)) {
            $invitationToken = bin2hex(random_bytes(16)); 
            $updateQuery = "UPDATE users SET admin_invitation_token = :token WHERE id = :user_id";
            $updateStmt = $dbInstance->prepare($updateQuery);
            $updateStmt->bindParam(':token', $invitationToken);
            $updateStmt->bindParam(':user_id', $userId);

            // envoyer un email d'invitation à l'utilisateur
            if ($updateStmt->execute()) {

                // Préparer l'email d'invitation

                $headers = [
                    'From' => $GLOBALS['siteEmail'],
                    'Reply-To' => '' . $GLOBALS['siteEmail'],
                    'X-Mailer' => 'PHP/' . phpversion(),
                    'Content-Type' => 'text/plain; charset=UTF-8',
                    'Content-Transfer-Encoding' => '8bit',
                    'MIME-Version' => '1.0',
                    'X-Priority' => '3', // Normal priority
                    'X-MSMail-Priority' => 'Normal'
                ];


                $subject = "Invitation à rejoindre l'équipe d'administration";
                $message = "Bonjour $username,\n\nVous avez été invité à rejoindre l'équipe d'administration. Veuillez cliquer sur le lien suivant pour accepter l'invitation :\n";
                $message .= "https://$GLOBALS[siteDomain]/profile/invitationVerification?token=$invitationToken\n\nCordialement,\nL'équipe SAE202";
                mail($email, $subject, $message, $headers);
            } else {
                return ['success' => false, 'message' => 'Erreur lors de la création du token d\'invitation.'];
            }

              // L'utilisateur a été créé avec succès
        return ['success' => true, 'message' => 'Utilisateur créé avec succès. Un email d\'invitation a été envoyé.'];


        }else{
              // L'utilisateur a été créé avec succès
        return ['success' => true, 'message' => 'Utilisateur créé avec succès.'];
        }

      
    } else {
        // Une erreur s'est produite lors de la création de l'utilisateur
        return ['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur.'];
    }
}




/**
 * Fonction pour vérifier les informations d'identification de l'utilisateur
 *
 * @param string $username
 * @param string $password
 * @param bool $remember
 * @return array
 */
function login_user(string $username, string $password, bool $remember = true): array
{
   
    global $dbInstance;
    $user = getUser($username);

    //   var_dump($user);
    //   die();
    // Vérifier si l'utilisateur existe dans la base de données

    if (!$user) {
        return ['success' => false, 'message' => 'Utilisateur non trouvé.'];
    }


    // Récupérer le mot de passe haché de l'utilisateur;
    $hashedPassword = $user['password'];

    // Vérifier le mot de passe
    if (password_verify($password, $hashedPassword)) {

        unset($user['password']);

        
        // mettre à jour sa dernière connexion
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE users SET last_connexion = :last_connexion WHERE id = :user_id";
        $stmt = $dbInstance->prepare($query);
        $stmt->bindParam(':last_connexion', $date);
        $stmt->bindParam(':user_id', $user['id']);

        $stmt->execute();

        $hashedToken = "";
        // Si l'utilisateur a choisi de rester connecté, on peut gérer le cookie
        if ($remember && $_SERVER['REQUEST_SCHEME']  === 'https') {

            // On suppose que l'utilisateur a un ID unique dans la base de données
            $userId = $user['id'];

            // Générer un jeton aléatoire sécurisé
            $token = bin2hex(random_bytes(32)); // 64 caractères hexadécimaux
            $hashedToken = password_hash($token, PASSWORD_DEFAULT); // Hasher le jeton pour le stocker en BDD

            // Enregistrer le jeton dans la base de données
            createUserToken($userId, $hashedToken);
        }


        // Authentification réussie
        return ['success' => true, 'message' => 'Authentification réussie.', 'token' => $hashedToken, 'user' => $user];
    } else {
        // Mot de passe incorrect
        return ['success' => false, 'message' => 'Mot de passe incorrect.'];
    }
}

function getAdminUsers(): ?array
{
    global $dbInstance;

    // Récupérer les utilisateurs avec le rôle 'admin'
    $query = "SELECT * FROM users WHERE role = 'admin'";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $users = $stmt->fetchAll();
        foreach ($users as $key => $user) {

            $users[$key]=  array_merge(getUserProfile($user['id']), $users[$key]) ; // Récupérer le profil de l'utilisateur
            unset($users[$key]['password']); // Ne pas retourner le mot de passe
            unset($users[$key]['admin_invitation_token']); // Ne pas retourner le token d'invitation
            unset($users[$key]['valid_admin']); // Ne pas retourner la validité de l'utilisateur admin
        }
        return $users;
    }

    return null; // Aucun utilisateur admin trouvé
}


function getUser(string $username): ?array
{
    global $dbInstance;

    // Récupérer les informations de l'utilisateur
    $query = "SELECT * FROM users WHERE username = :username OR email = :username";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch();
    }

    return null; // L'utilisateur n'existe pas
}

function getUserByToken(string $token): ?array
{
    global $dbInstance;

    // Récupérer l'utilisateur par le token le plus récent
    $query = "SELECT u.*, rt.token FROM users u
              JOIN remember_tokens rt ON u.id = rt.user_id
              WHERE rt.token = :token AND rt.expires_at > NOW()
              ORDER BY rt.expires_at DESC LIMIT 1";

    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        unset($user['password']); // Ne pas retourner le mot de passe
        unset($user['admin_invitation_token']); // Ne pas retourner le token d'invitation
        return $user;
    }

    return null; // Aucun utilisateur trouvé avec ce token
}

function getUserById(int $userId): ?array
{
    global $dbInstance;

    // Récupérer les informations de l'utilisateur par ID
    $query = "SELECT * FROM users WHERE id = :userId";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        unset($user['password']); // Ne pas retourner le mot de passe
        return $user;
    }

    return null; // L'utilisateur n'existe pas
}


function createUserToken(int $userId, string $hashedToken): bool
{
    global $dbInstance;

    // Insérer ou mettre à jour le token de l'utilisateur dans la base de données
    $query = "INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (:userId, :token, DATE_ADD(NOW(), INTERVAL 10 DAY))
              ON DUPLICATE KEY UPDATE token = :token, expires_at = DATE_ADD(NOW(), INTERVAL 10 DAY)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':token', $hashedToken);

    return $stmt->execute();
}



function updateUserToken(int $userId, string $newHashedToken): bool
{
    global $dbInstance;

    // Mettre à jour le token de l'utilisateur dans la base de données
    $query = "UPDATE remember_tokens SET token = :token, expires_at = DATE_ADD(NOW(), INTERVAL 10 DAY) WHERE user_id = :userId";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':token', $newHashedToken);
    $stmt->bindParam(':userId', $userId);

    return $stmt->execute();
}


function getAllUsers(): ?array
{
    global $dbInstance;

    // Récupérer tous les utilisateurs de la base de données
    $query = "SELECT * FROM users";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $users = $stmt->fetchAll();
        foreach ($users as $user) {
            unset($user['password']);
        }
        return $users;
    }
    return null; // Aucun utilisateur trouvé
}


function deleteUser(int $userId): bool
{
    global $dbInstance;

    try {
        // Démarrer la transaction
        $dbInstance->beginTransaction();

        // Supprimer le token de l'utilisateur
        $query = "DELETE FROM remember_tokens WHERE user_id = :user_id";
        $stmt = $dbInstance->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        // Supprimer le profil de l'utilisateur
        $query = "DELETE FROM profiles WHERE user_id = :user_id";
        $stmt = $dbInstance->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        // Supprimer l'utilisateur de la base de données
        $query = "DELETE FROM users WHERE id = :user_id";
        $stmt = $dbInstance->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        // Valider la transaction
        $dbInstance->commit();
    } catch (\PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $dbInstance->rollBack();
        return false;
    }

    return $stmt->execute();
}

function verifyUserAdminInvitation(string $token): ?array
{
    global $dbInstance;

    // Récupérer l'utilisateur par le token d'invitation
    $query = "SELECT * FROM users WHERE admin_invitation_token = :token";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        // Vérifier si le token est valide
        if (hash_equals($token, $user['admin_invitation_token'])) {

            // mettre à jour la colonne valid_admin 
            $updateQuery = "UPDATE users SET valid_admin = 1 WHERE id = :user_id";
            $updateStmt = $dbInstance->prepare($updateQuery);
            $updateStmt->bindParam(':user_id', $user['id']);
            if ($updateStmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Invitation validée avec succès.',
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Erreur lors de la validation de l\'invitation.',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Token d\'invitation invalide.',
            ];
        }
    }
    return [
        'success' => false,
        'message' => 'Aucun utilisateur trouvé avec ce token.',
    ]; // Aucun utilisateur trouvé avec ce token
}