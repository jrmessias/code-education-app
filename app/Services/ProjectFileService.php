<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 15/01/2016
 * Time: 23:55
 */

namespace JrMessias\Services;

use Illuminate\Contracts\Filesystem\Factory as Store;
use Illuminate\Filesystem\Filesystem;
use JrMessias\Repositories\ProjectFileRepository;
use JrMessias\Repositories\ProjectRepository;
use JrMessias\Validators\ProjectFileValidator;


class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    protected $repository;

    /**
     * @var ProjectFileValidator
     */
    private $validator;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var Factory
     */
    private $store;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectFileRepository $projectFileRepository, ProjectFileValidator $projectFileValidator,
                                Filesystem $fileSystem, Store $store, ProjectRepository $projectRepository)
    {
        $this->repository = $projectFileRepository;
        $this->validator = $projectFileValidator;
        $this->fileSystem = $fileSystem;
        $this->store = $store;

        $this->projectRepository = $projectRepository;
    }

    /**
     * @param $idProject int
     * @param $idFile int
     * @return mixed
     */
    public function create(array $data)
    {
        $project = $this->projectRepository->skipPresenter()->find($data['project_id']);


        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        $data['file_name'] = date('YmdHis') . "-" . md5(uniqid(rand(), true)) . "." . $data['extension'];

        $projectFile = $this->repository->create($data);

        return $this->store->put($data['file_name'], $this->fileSystem->get($data['file']));
    }

}