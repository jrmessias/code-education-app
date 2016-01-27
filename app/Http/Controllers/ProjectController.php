<?php

namespace JrMessias\Http\Controllers;

use JrMessias\Http\Requests;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

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
        $idUser = Authorizer::getResourceOwnerId();

        return $this->repository->findWhere(['owner_id' => $idUser]);
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
        if (!$this->checkOwner($id)) {
            return ['success' => false];
        }

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
        if (!$this->checkPermissions($id)) {
            return ['success' => false];
        }

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
        if (!$this->checkOwner($id)) {
            return ['success' => false];
        }

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

    private function checkOwner($idProject)
    {
        $idUser = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($idProject, $idUser);
    }

    private function checkMember($idProject)
    {
        $idUser = Authorizer::getResourceOwnerId();

        return $this->repository->isMember($idProject, $idUser);
    }

    private function checkPermissions($idProject)
    {
        if ($this->checkOwner($idProject) ||
            $this->checkMember($idProject)
        ) {
            return true;
        }
        return false;

    }
}
