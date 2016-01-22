<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;

use JrMessias\Http\Requests;
use JrMessias\Http\Controllers\Controller;
use JrMessias\Repositories\ProjectMemberRepository;
use JrMessias\Services\ProjectMemberService;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberService
     */
    protected $service;

    public function __construct(ProjectMemberRepository $projectMemberRepository, ProjectMemberService $projectMemberService)
    {
        $this->repository = $projectMemberRepository;
        $this->service = $projectMemberService;
    }

    public function add($idProject, $idMember)
    {
        return $this->service->addMember($idProject, $idMember);
    }

    public function remove($idProject, $idMember)
    {
        try {
            return $this->service->removeMember($idProject, $idMember);
            return ['status' => true, 'message' => 'Membro do projeto excluído com sucesso'];
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir a nota do projeto'];
        }

    }

    public function have($idProject, $idMember)
    {
        return $this->service->isMember($idProject, $idMember);
    }

    public function get($idProject)
    {
        return $this->service->getMembers($idProject);
    }
}
