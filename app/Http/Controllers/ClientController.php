<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;
use JrMessias\Repositories\ClientRepository;
use JrMessias\Services\ClientService;

class ClientController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientRepository $clientRepository, ClientService $clientService)
    {
        $this->repository = $clientRepository;
        $this->service = $clientService;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        return $this->service->find($id)->update($request->all());
    }

    /**
     * @param $id int
     * @return Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }


    /**
     * @param $id int
     * @return Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
