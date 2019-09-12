<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * AdminFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'Test123'
        ));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setApiToken('HA9vWWu43mPD2aZe');
        $manager->persist($admin);
        $manager->flush();
    }
}
