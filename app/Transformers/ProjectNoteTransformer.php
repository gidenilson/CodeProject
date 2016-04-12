<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{
    public function transform (ProjectNote $projectNote){

        return [
            "id"=>$projectNote->id,
            "project_id"=>$projectNote->project_id,
            "title"=>$projectNote->title,
            "note"=>$projectNote->note,
            "created_date"=>$projectNote->created_date,
            "updated_date"=>$projectNote->updated_date
        ];
    }
}