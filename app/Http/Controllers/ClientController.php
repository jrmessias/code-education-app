<?php

namespace JrMessias\Http\Controllers;

use JrMessias\Http\Requests;
use JrMessias\Repositories\ClientRepository;
use JrMessias\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        try {
            return $this->repository->find($id)->update($request->all());
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível atualizar o cliente'];
        }
    }

    /**
     * @param $id int
     * @return Response
     */
    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Não foi possível exibir o cliente'];
        }
    }


    /**
     * @param $id int
     * @return Response
     */
    public function destroy($id)
    {
        try {
            return $this->repository->find($id)->delete();
            return ['status' => true, 'message' => 'Projeto excluído com sucesso'];
        } catch (\PDOException $e) {
            return ['status' => false, 'message' => 'Não foi possível excluir o cliente'];
        }
    }
}
