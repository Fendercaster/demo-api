<?php

namespace App\Repository;

use App\Entity\UserGroup;

interface UserGroupRepositoryInterface
{

    /**
     * @param UserGroup $userGroup
     */
    public function save(UserGroup $userGroup): void;

    /**
     * @param UserGroup $userGroup
     */
    public function delete(UserGroup $userGroup): void;

    /**
     * @param int $id
     * @return UserGroup|null
     */
    public function findById(int $id): ?UserGroup;

}
