<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 15/01/2016
 * Time: 23:55
 */

namespace JrMessias\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use JrMessias\Repositories\ProjectMemberRepository;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberRepository
     */
    protected  $projectMemberRepository;

    /**
     * @var ProjectValidator
     */
    private $validator;

    public function __construct(ProjectRepository $projectRepository, ProjectValidator $projectValidator, ProjectMemberRepository $projectMemberRepository)
    {
        $this->repository = $projectRepository;
        $this->validator = $projectValidator;
        $this->projectMemberRepository = $projectMemberRepository;
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
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

}