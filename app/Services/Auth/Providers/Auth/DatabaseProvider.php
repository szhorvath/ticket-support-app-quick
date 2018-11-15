<?php

namespace App\Services\Auth\Providers\Auth;

use App\Models\User;
use App\Services\Auth\Providers\Auth\AuthProviderInterface;

class DatabaseProvider implements AuthProviderInterface
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function byCredentials(string $username, string $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$username]);

        if (!$user = $stmt->fetch()) {
            return null;
        }

        if (!password_verify($password, $user->password)) {
            return null;
        }

        return $this->byId($user->id);
    }

    public function byId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}
