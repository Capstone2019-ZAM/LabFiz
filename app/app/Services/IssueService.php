<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Repositories\ModelRepository;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class IssueService implements RestServiceContract
{
    protected $model_user;

    public function __construct(User $user)
    {
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function get_all()
    {
        // TODO: Implement get_all() method.
    }

    public function create(FormRequest $request)
    {
        // TODO: Implement create() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
