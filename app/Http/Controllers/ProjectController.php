<?php

namespace JrMessias\Http\Controllers;

use JrMessias\Http\Requests;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        return $this->service->all();
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
        try {
            return $this->repository->find($id)->update($request->all());
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível atualizar o projeto'];
        }
    }

    /**
     * @param $id int
     * @return Response
     */
    public function show($id)
    {
        try {
            return $this->service->find($id);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível localizar o projeto'];
        }
    }


    /**
     * @param $id int
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return ['status' => true, 'message' => 'Projeto excluído com sucesso'];
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir o projeto'];
        }
    }

    /**
     * @param $id int
     * @return Response
     */
    public function members($id)
    {
        try {
            return $this->service->getMembers($id);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir o projeto'];
        }
    }
}
