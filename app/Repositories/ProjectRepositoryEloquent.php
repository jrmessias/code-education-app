<?php

namespace JrMessias\Repositories;

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
}
