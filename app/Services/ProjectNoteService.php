<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 15/01/2016
 * Time: 23:55
 */

namespace JrMessias\Services;

use JrMessias\Repositories\ProjectNoteRepository;
use JrMessias\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskValidator
     */
    private $validator;

    public function __construct(ProjectNoteRepository $projectNoteRepository, ProjectNoteValidator $projectNoteValidator)
    {
        $this->repository = $projectNoteRepository;
        $this->validator = $projectNoteValidator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        return $this->repository->skipPresenter()->create($data);

    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        return $this->repository->skipPresenter()->update($data, $id);
    }

    public function all()
    {
        return $this->repository->skipPresenter()->with(['project'])->all();
    }

    public function find($id)
    {
        return $this->repository->skipPresenter()->with(['project'])->find($id);
    }

    /**
     * @param $idProject
     * @return int
     */
    public function getNotes($idProject)
    {
        try {
            $data = ['project_id' => $idProject];
            return $this->repository->skipPresenter()->findWhere($data);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

}