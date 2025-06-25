<?php

require_once dirname(__DIR__, 2) . "/conf/conf.inc.php";

function getUsers(): array
{
    global $dbInstance;

    $query = "SELECT * FROM users ORDER BY username ASC";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    global $dbInstance;

    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
    unset($user['password']); // Remove password for security
    unset($user['admin_invitation_token']); // Remove admin invitation token if exists
    }
    return $user;
}

function createUser($username, $password, $email): bool
{
    global $dbInstance;

    $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateUser($id, $username, $email): bool
{
    global $dbInstance;

    $query = "UPDATE users SET username = :username, email = :email WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    return $stmt->execute();
}

function deleteUser($id): bool
{
    global $dbInstance;

    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $dbInstance->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function countUsers() {
    global $dbInstance;

    $query = "SELECT COUNT(*) FROM users";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    return $stmt->fetchColumn();
}


function getNonAdminUsers(): array
{
    global $dbInstance;

    $query = "SELECT * FROM users WHERE role != 'admin' ORDER BY username ASC";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as &$user) {
        unset($user['password']); // Remove password for security
        unset($user['admin_invitation_token']); // Remove admin invitation token if exists
    }
    return $users;
}

function getAdminInfos() {
    global $dbInstance;

    $query = "SELECT email, id FROM users WHERE role = 'admin' LIMIT 1";
    $stmt = $dbInstance->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ?? null;
}