<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use League\Flysystem\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    protected $repository;
    protected $validator;


    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        } catch (ValidatorException $e) {
            return [
                "error" => true,
                "message" => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id, $noteId)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            if (! count($this->repository->skipPresenter()->findWhere(['project_id'=>$id, 'id'=>$noteId]))) {
                throw new \Exception();
            }
            return $this->repository->update($data, $noteId);

        } catch (ValidatorException $e) {
            return [
                "error" => true,
                "message" => $e->getMessageBag()
            ];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => "The specified resource does not exist."
            ];
        }


    }


}