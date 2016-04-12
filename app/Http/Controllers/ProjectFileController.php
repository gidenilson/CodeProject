<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{

    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileService
     */
    private $service;

    public function __construct(ProjectFileRepository $repository, ProjectFileService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $this->service->create($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $fileId)
    {
        $this->repository->find($fileId);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $fileId)
    {
        $this->service->update($request->all(), $id, $fileId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $fileId)
    {
        return $this->service->destroy($id, $fileId);
    }
}
