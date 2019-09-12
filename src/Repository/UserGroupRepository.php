<?php

namespace App\Repository;

use App\Entity\UserGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method UserGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGroup[]    findAll()
 * @method UserGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGroupRepository extends ServiceEntityRepository implements UserGroupRepositoryInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserGroupRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($registry, UserGroup::class);
    }

    /**
     * @param UserGroup $userGroup
     */
    public function save(UserGroup $userGroup): void
    {
        $this->entityManager->persist($userGroup);
        $this->entityManager->flush();
    }

    /**
     * @param UserGroup $userGroup
     */
    public function delete(UserGroup $userGroup): void
    {
        $this->entityManager->remove($userGroup);
        $this->entityManager->flush();
    }

    /**
     * @param int $id
     * @return UserGroup|null
     */
    public function findById(int $id): ?UserGroup
    {
        return $this->entityManager->find(UserGroup::class, $id);
    }

}
