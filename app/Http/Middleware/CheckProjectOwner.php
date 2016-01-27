<?php

namespace JrMessias\Http\Middleware;

use Closure;
use JrMessias\Repositories\ProjectRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckProjectOwner
{

    /**
     * @var ProjectRepository
     */
    private $repository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->repository = $projectRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $idUser = Authorizer::getResourceOwnerId();
        $idProject = $request->project;

        if ($this->repository->isOwner($idProject, $idUser) == false) {
            return ['success' => false];
        }
        return $next($request);
    }
}
