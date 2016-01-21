<?php

namespace JrMessias\Http\Controllers;

use JrMessias\Http\Requests;
use JrMessias\Repositories\ProjectNoteRepository;
use JrMessias\Services\ProjectNoteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteRepository
     */
    private $repository;

    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $projectNoteRepository, ProjectNoteService $projectNoteService)
    {
        $this->repository = $projectNoteRepository;
        $this->service = $projectNoteService;
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
     * @param $idNote int
     * @return Response
     */
    public function update(Request $request, $id = null, $idNote = null)
    {
        try {
            return $this->service->update($request->all(), $idNote);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível atualizar a nota do projeto'];
        }
    }

    /**
     * @param $id int
     * @param $idNote int
     * @return Response
     */
    public function show($id, $idNote)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $idNote]);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível localizar a nota do projeto'];
        }
    }


    /**
     * @param $id int
     * @param $idNote int
     * @return Response
     */
    public function destroy($id, $idNote)
    {
        try {
            $this->repository->delete($idNote);
            return ['status' => true, 'message' => 'Nota do projeto excluída com sucesso'];
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir a nota do projeto'];
        }
    }
}
