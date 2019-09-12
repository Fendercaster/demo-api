<?php

namespace App\Controller\Rest;

use App\Application\GroupService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends FOSRestController
{

    /**
     * @var GroupService
     */
    protected $groupService;

    /**
     * GroupController constructor.
     * @param GroupService $groupService
     */
    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * @Rest\Post("/groups")
     * @return bool|object|null
     */
    public function createGroup(Request $request): View
    {
        return $this->groupService->createGroup($request);

    }

    /**
     * @Rest\Delete("/groups/{id}")
     * @return bool|object|null
     */
    public function deleteGroup($id): View
    {
        return $this->groupService->deleteGroup($id);
    }

}
