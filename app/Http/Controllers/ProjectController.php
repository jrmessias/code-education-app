<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;

use JrMessias\Http\Requests;
use JrMessias\Http\Controllers\Controller;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Services\ProjectService;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $projectRepository, ProjectService $projectService)
    {
        $this->repository = $projectRepository;
        $this->service = $projectService;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return $this->repository->with(['owner', 'client'])->all();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        return $this->service->with(['owner', 'client'])->find($id)->update($request->all());
    }

    /**
     * @param $id int
     * @return Response
     */
    public function show($id)
    {
        return $this->repository->with(['owner', 'client'])->find($id);
    }


    /**
     * @param $id int
     * @return Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
