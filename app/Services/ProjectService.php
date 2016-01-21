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
        return $this->repository->with(['project'])->all();
    }

    public function find($id)
    {
        return $this->repository->with(['project'])->find($id);
    }

    /**
     * @param $idProject int
     * @param $idMember int
     * @return mixed
     */
    public function addMember($idProject, $idMember)
    {
        $data = ['project_id' => $idProject, 'user_id' => $idMember];
        return $this->projectMemberRepository->create($data);
    }

    /**
     * @param $idProject int
     * @param $idMember int
     * @return array
     */
    public function removeMember($idProject, $idMember)
    {
        try {
            $data = ['project_id' => $idProject, 'user_id' => $idMember];
            return $this->projectMemberRepository->findWhere($data)->delete();
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $idProject int
     * @param $idMember int
     * @return array|mixed
     */
    public function isMember($idProject, $idMember)
    {
        try {
            $data = ['project_id' => $idProject, 'user_id' => $idMember];
            return $this->projectMemberRepository->findWhere($data);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getMembers($idProject)
    {
        try {
            $data = ['project_id' => $idProject];
            return $this->projectMemberRepository->findWhere($data);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }


}