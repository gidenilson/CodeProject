<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
    public function transform (ProjectFile $projectFile){

        return [
            "id"=>$projectFile->id,
            "project_id"=>$projectFile->project_id,
            "name"=>$projectFile->name,
            "description"=>$projectFile->description,
            "original_file"=>$projectFile->original_file,
            "storage_file"=>$projectFile->storage_file,
            "extension"=>$projectFile->extension,
            "mime"=>$projectFile->mime,
            "size"=>$projectFile->size,
            "created_date"=>$projectFile->created_date,
            "updated_date"=>$projectFile->updated_date
        ];
    }
}