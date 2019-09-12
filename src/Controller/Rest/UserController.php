<?php

namespace App\Controller\Rest;

use App\Application\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends FOSRestController
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Rest\Post("/users")
     * @return bool|object|null
     */
    public function createUser(Request $request): View
    {
        return $this->userService->createUser($request);

    }

    /**
     * @Rest\Get("/users/{id}")
     * @return bool|object|null
     */
    public function getUserById(int $id): View
    {
        return $this->userService->getUserById($id);
    }

    /**
     * @Rest\Delete("/users/{id}")
     * @return bool|object|null
     */
    public function deleteUserById(int $id): View
    {
        return $this->userService->deleteUserById($id);
    }

    /**
     * @Rest\Put("/users/{id}")
     * @return bool|object|null
     */
    public function updateUser(int $id, Request $request): View
    {
        return $this->userService->updateUser($id, $request);

    }

    /**
     * @Rest\Put("/users/{id}/nogroup")
     * @return bool|object|null
     */
    public function removeUserFromGroup(int $id): View
    {
        return $this->userService->removeUserFromGroup($id);

    }

}
