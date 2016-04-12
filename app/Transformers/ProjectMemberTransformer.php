<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform (ProjectMember $projectMember){

        return [
            "id"=>$projectMember->id,
            "project_id"=>$projectMember->project_id,
            "user_id"=>$projectMember->user_id,
            "created_date"=>$projectMember->created_date,
            "updated_date"=>$projectMember->updated_date
        ];
    }
}
