<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user): void;

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

}
