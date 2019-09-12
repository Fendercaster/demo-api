<?php

namespace App\Application;

use App\Entity\User;
use App\Entity\UserGroup;
use App\Repository\UserGroupRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserService
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
     * @param Request $request
     * @return View
     */
    public function createUser(Request $request): View
    {
        $user = new User();
        $name = $request->get('name');
        $groupId = $request->get('group_id');
        if (!$name) {
            return View::create("Name is required", Response::HTTP_BAD_REQUEST);
        }
        try {
            $user->setName($name);
            if ($groupId) {
                $group = $this->getGroup($groupId);
                if ($group) {
                    $user->setUserGroup($group);
                }
            }
            $this->userRepository->save($user);

            return View::create($user, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @param int $id
     * @return View
     */
    public function getUserById(int $id): View
    {
        try {
            $user = $this->userRepository->findById($id);
        } catch (Exception $exception) {
            return View::create('User not found', Response::HTTP_NOT_FOUND);
        }

        if($user instanceof User){
            return View::create($user, Response::HTTP_OK);
        } else {
            return View::create('User not found', Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * @param int $id
     * @return View
     */
    public function deleteUserById(int $id): View
    {
        try {
            $user = $this->userRepository->findById($id);
            $this->userRepository->save($user);
        } catch (Exception $exception) {
            return View::create('User not found or is already deleted', Response::HTTP_NOT_FOUND);
        }

        return View::create('User deleted', Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return View
     */
    public function updateUser(int $id, Request $request): View
    {
        $name = $request->get('name');
        $groupId = $request->get('group_id');
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return View::create('User not found', Response::HTTP_NOT_FOUND);
        }
        try {
            if($name) {
                $user->setName($name);
            }
            if ($groupId) {
                $group = $this->getGroup($groupId);
                if ($group) {
                    $user->setUserGroup($group);
                }
            }
            $this->userRepository->save($user);

            return View::create($user, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @param int $id
     * @return View
     */
    public function removeUserFromGroup(int $id): View
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return View::create('User not found', Response::HTTP_NOT_FOUND);
        }
        try {
            $user->setUserGroup(null);
            $this->userRepository->save($user);

            return View::create($user, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @param $groupId
     * @return UserGroup|object|null
     */
    private function getGroup($groupId)
    {
        return $this->groupRepository->findById($groupId);
    }

}