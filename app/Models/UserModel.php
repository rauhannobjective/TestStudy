<?php

namespace App\Models;

use App\Entities\User;
use Exception;

class UserModel
{
    private User $userEntity;

    public function __construct(User $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * Retorna um usuário pelo id.
     *
     * @param integer $id
     * @return User
     */
    public function getById(int $id): User
    {
        $user = $this->userEntity->find($id);

        if (!$user) {
            throw new Exception('Usuário não encontrado');
        }

        return $user;
    }
}
