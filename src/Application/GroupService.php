<?php

namespace App\Application;

use App\Entity\UserGroup;
use App\Repository\UserGroupRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var UserGroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserGroupRepositoryInterface $userGroupRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserGroupRepositoryInterface $userGroupRepository)
    {
        $this->userRepository = $userRepository;
        $this->groupRepository = $userGroupRepository;
    }

    /**
     * @Rest\Post("/groups")
     * @return bool|object|null
     */
    public function createGroup(Request $request): View
    {
        $group = new UserGroup();
        $title = $request->get('title');
        if(!$title){
            return View::create("Title is required", Response::HTTP_BAD_REQUEST);
        }
        try {
            $group->setTitle($title);
            $this->groupRepository->save($group);
            return View::create($group, Response::HTTP_CREATED);
        } catch (\Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Delete("/groups/{id}")
     * @return bool|object|null
     */
    public function deleteGroup($id): View
    {
        $userGroup = $this->groupRepository->findById($id);
        try {
            $this->groupRepository->delete($userGroup);
            return View::create('Group was removed', Response::HTTP_CREATED);
        } catch (Exception $exception){
            return View::create('Group have active users. Cannot delete group with active users', Response::HTTP_BAD_REQUEST);
        }

    }

}