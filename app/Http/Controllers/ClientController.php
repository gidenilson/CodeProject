<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Entities\Client;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Repositories\ClientRepositoryEloquent;
use CodeProject\Services\ClientService;
use CodeProject\Validators\ClientValidator;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ClientController extends Controller
{
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    /**
     * ClientController constructor.
     * @param $repository
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => "The specified resource does not exist."
            ];
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        return $this->service->update($request->all(), $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $client = $this->repository->find($id);
            $this->repository->delete($id);
            return ["success"=>true, "message" =>"client deleted."];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => "The specified resource does not exist."
            ];
        }
    }
}
