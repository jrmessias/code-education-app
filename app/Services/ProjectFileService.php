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
use Mockery\CountValidator\Exception;


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
     * @param $data array
     * @return array
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

        try {
            $this->store->put($data['file_name'], $this->fileSystem->get($data['file']));
        } catch (\Exception $e) {

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        return [
            'error' => false,
            'message' => ''
        ];
    }

    /**
     * @param $data array
     * @return array
     */
    public function destroy($filename)
    {
        $file = $this->repository->findWhere(['file_name' => $filename]);

        $this->store->delete($filename);
        return [
            'error' => false,
            'message' => ''
        ];
    }

}