<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;
use JrMessias\Http\Requests;
use JrMessias\Repositories\ProjectTaskRepository;
use JrMessias\Services\ProjectTaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    /**
     * @var ProjectTaskService
     */
    private $service;

    public function __construct(ProjectTaskRepository $projectTaskRepository, ProjectTaskService $projectTaskService)
    {
        $this->repository = $projectTaskRepository;
        $this->service = $projectTaskService;
    }

    /**
     * @param $id int
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
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
     * @param Request $request
     * @param $id int
     * @param $idTask int
     * @return Response
     */
    public function update(Request $request, $id = null, $idTask = null)
    {
        try {
            return $this->service->update($request->all(), $idTask);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível atualizar a tarefa do projeto'];
        }
    }

    /**
     * @param $id int
     * @param $idTask int
     * @return Response
     */
    public function show($id, $idTask)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $idTask]);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível localizar a tarefa do projeto'];
        }
    }


    /**
     * @param $id int
     * @param $idTask int
     * @return Response
     */
    public function destroy($id, $idTask)
    {
        try {
            $this->repository->delete($idTask);
            return ['status' => true, 'message' => 'Tarefa do projeto excluída com sucesso'];
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir a tarefa do projeto'];
        }
    }
}
