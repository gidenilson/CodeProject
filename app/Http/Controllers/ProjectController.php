<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    /**
     * ProjectController constructor.
     * @param $repository
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
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

       return $this->repository->with(['owner', 'client'])->findWhere(['owner_id' => Authorizer::getResourceOwnerId()]);


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
        if(!$this->checkProjectPermissions($id)){
            return ["error" => "Access forbidden"];
        }
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
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
        if(!$this->checkProjectPermissions($id)){
            return ["error" => "Access forbidden"];
        }
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
        if(!$this->checkProjectPermissions($id)){
            return ["error" => "Access forbidden"];
        }
        try {
            $client = $this->repository->find($id);
            $this->repository->delete($id);
            return ["success"=>true, "message" =>"Project deleted."];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => "The specified resource does not exist."
            ];
        }
    }
    public function members($id) {
        return $this->service->getMembers($id);
    }

    public function add_member(Request $request, $id) {
        return $this->service->addMember($id, $request->user_id);
    }
    public function remove_member(Request $request, $id, $memberId) {
        return $this->service->removeMember($id, $memberId);
    }

    private function checkProjectOwner($id){


        return $this->service->isOwner($id, Authorizer::getResourceOwnerId());
    }
    private function checkProjectMember($id){

        return $this->service->isMember($id, Authorizer::getResourceOwnerId());
    }
    private function checkProjectPermissions($id){

        return $this->checkProjectMember($id) or $this->checkProjectOwner($id)  ;
    }

}
