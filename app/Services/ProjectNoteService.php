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

        return $this->repository->create($data);

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

        return $this->repository->update($data, $id);
    }

    public function all()
    {
        return $this->repository->with(['project'])->all();
    }

    public function find($id)
    {
        return $this->repository->with(['project'])->find($id);
    }

}