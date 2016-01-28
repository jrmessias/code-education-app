<?php

namespace JrMessias\Repositories;

use JrMessias\Presenters\ProjectPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Entities\Project;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace JrMessias\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    public function isOwner($idProject, $idUser)
    {
        if(count($this->findWhere(['id' => $idProject, 'owner_id' => $idUser]))){
            return true;
        }

        return false;
    }

    public function isMember($idProject, $idUser)
    {
        $project = $this->find($idProject);

        foreach($project->members as $member){
            if($member->id == $idUser){
                return true;
            }
        }

        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
