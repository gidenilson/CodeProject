<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'extension',
        'original_file',
        'storage_file',
        'mime',
        'size'
    ];

    public function project(){

            return $this->belongsTo(Project::class);

    }

}
