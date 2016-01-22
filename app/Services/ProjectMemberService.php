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
use JrMessias\Validators\ProjectMemberValidator;
use JrMessias\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberService
     */
    protected $service;

    /**
     * @var ProjectValidator
     */
    private $validator;

    public function __construct(ProjectMemberRepository $projectMemberRepository, ProjectMemberValidator $projectMemberValidator)
    {
        $this->repository = $projectMemberRepository;
        $this->validator = $projectMemberValidator;
    }

    /**
     * @param $idProject int
     * @param $idMember int
     * @return mixed
     */
    public function addMember($idProject, $idMember)
    {
        $data = ['project_id' => $idProject, 'user_id' => $idMember];
        return $this->repository->create($data);
    }

    /**
     * @param $idProject int
     * @param $idMember int
     * @return array
     */
    public function removeMember($idProject, $idMember)
    {
        $data = ['project_id' => $idProject, 'user_id' => $idMember];
        $member = $this->repository->findWhere($data);
        try {
            if (count($member) > 0) {
                $this->repository->delete($member[0]['attributes']['id']);
            }
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
            return $this->repository->with(['project', 'user'])->findWhere($data);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $idProject
     * @return int
     */
    public function getMembers($idProject)
    {
        try {
            $data = ['project_id' => $idProject];
            return $this->repository->with(['project', 'user'])->findWhere($data);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

}