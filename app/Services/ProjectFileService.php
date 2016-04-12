<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use League\Flysystem\Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjectFileService
{
    protected $repository;
    protected $validator;


    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(Request $request)
    {
        $data = $request->all();

        try {
            $this->validator->with($data)->passesOrFail();
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $storageName = time() . "_" . strtolower(str_random(4)) . "." . $extension;
            $data['extension'] = $extension;
            $data['original_file'] = $file->getClientOriginalName();
            $data['storage_file'] = $storageName;
            $data['mime'] = $file->getClientMimeType();
            $data['size'] = $file->getClientSize();
            if (!Storage::put($storageName, $file)) {
                throw new ValidatorException(new MessageBag("file storage failed"));
            }

            //return $data;
            return $this->repository->create($data);

        } catch (ValidatorException $e) {
            return [
                "error" => true,
                "message" => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id, $fileId)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            if (!count($this->repository->skipPresenter()->findWhere(['project_id' => $id, 'id' => $fileId]))) {
                throw new \Exception();
            }
            return $this->repository->update($data, $fileId);

        } catch (ValidatorException $e) {
            return [
                "error" => true,
                "message" => $e->getMessageBag()
            ];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => "Resource not found."
            ];
        }


    }

    public function destroy($id, $fileId)
    {
        try {
            $model = $this->repository->skipPresenter()->findWhere(['id' => $fileId, 'project_id' => $id]);

            if (!count($model)) {
                throw new \Exception("Resource not found.");
            }
            $file = $model[0];
            Storage::delete($file->storage_file);
            $this->repository->delete($file->id);
            return [
                "success" => true,
                "message" => "file removed"
            ];

        }catch (\Exception $e){
            return [
                "error"=>true,
                "message"=>$e->getMessage()
            ];
        }
    }


}