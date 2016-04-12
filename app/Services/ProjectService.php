<?php

namespace CodeProject\Services;




use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    protected $repository;
    protected $validator;
    /**
     * @var ProjectMemberRepository
     */
    private $member_repository;


    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $member_repository)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->member_repository = $member_repository;
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

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

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

    public function addMember($id, $user_id)
    {
        try{
            return $this->member_repository->create(['project_id'=>$id, 'user_id'=>$user_id]);
        }catch (\Exception $e){
            return [
                "error" => true,
                "message" => "Member can not be added to the project."
            ];
        }

    }

    public function removeMember($id, $user_id)
    {
        $member = $this->member_repository->skipPresenter()->findWhere(['project_id'=>$id, 'user_id'=>$user_id]);

        if(! count($member)) {
            return [
                "error" => true,
                "message" => "The specified resource does not exist."
            ];
        }
        $this->member_repository->delete($member[0]->id);
        return [
            "success" => true,
            "message" => "Removed."
        ];
    }

    public function isMember($id, $user_id){
        return count($this->member_repository->skipPresenter()->findWhere(['project_id'=>$id, 'user_id'=>$user_id]));


    }
    public function getMembers($id){
        return $this->member_repository->findWhere(['project_id'=>$id]);

    }
    public function isOwner($id, $user_id){
        return count($this->repository->skipPresenter()->findWhere(['owner_id'=>$user_id, 'id'=>$id]));
    }

    public function hasPermissions($id, $user_id){
        return $this->isMember($id, $user_id) or $this->isOwner($id, $user_id);
    }


}