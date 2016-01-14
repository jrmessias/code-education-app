<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use JrMessias\Client;
use JrMessias\Http\Requests;
use JrMessias\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return (JsonResponse::create(Client::all()));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $client = Client::find($id);
        $client->fill($request->all())->save();
        return (JsonResponse::create([]));
    }

    /**
     * @param $id int
     * @return Response
     */
    public function show($id)
    {
        return Client::find($id);
    }


    /**
     * @param $id int
     * @return Response
     */
    public function destroy($id)
    {
        return Client::destroy($id);
    }
}
