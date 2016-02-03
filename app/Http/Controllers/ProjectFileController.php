<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;
use JrMessias\Http\Requests;
use JrMessias\Repositories\ProjectFileRepository;
use JrMessias\Services\ProjectFileService;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileRepository
     */
    protected $repository;

    /**
     * @var ProjectFileService
     */
    protected $service;

    public function __construct(ProjectFileRepository $projectFileRepository, ProjectFileService $projectFileService)
    {
        $this->repository = $projectFileRepository;
        $this->service = $projectFileService;
    }

    public function store(Request $request)
    {
        $data = [];

        $file = $request->file('file');

        $data['extension'] = $file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        $this->service->create($data);
    }

}
