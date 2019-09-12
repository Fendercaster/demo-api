<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    private $demoUsers =
        [
            'John',
            'Jane',
            'Jonas',
            'Janina'
        ];

    private $demoUserGroups =
        [
            'normal',
            'vip'
        ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->demoUserGroups as $demoUserGroup){
            /** @var UserGroup $group */
            $group = new UserGroup();
            $group->setTitle($demoUserGroup);
            $manager->persist($group);
            $manager->flush();
        }
        foreach ($this->demoUsers as $demoUser)
        {
            /** @var User $user */
            $user = new User();
            $user->setName($demoUser);
            $manager->persist($user);
            $manager->flush();
        }
    }
}
