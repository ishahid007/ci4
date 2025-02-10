<?php

namespace App\Controllers\Api;

use App\Resources\UserResource;
use App\Validations\UserValidation;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

// use http\Client\Curl\UserResource;

class UsersController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';
    private UserValidation $userValidation;

    public function __construct()
    {
        $this->userValidation = new UserValidation();
    }

    public function index(): ResponseInterface
    {
        $users = $this->model->paginate(5);
//        dd($users);
        // Use the Resource
        return $this->respond(UserResource::collection($users));
    }

    public function create(): ResponseInterface
    {
        // -------------------- Validation --------------------
        $validatedData = $this->userValidation->validate($this->request->getPost());
        if (! $validatedData) {
            return $this->failValidationErrors($this->userValidation->errors());
        }
        // -------------------- Insert --------------------
        $this->model->insert($validatedData);

        // -------------------- Response --------------------
        return $this->respondCreated(['success' => true]);
    }

    public function show($id = null): ResponseInterface
    {
        $user = $this->model->find($id);
        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        return $this->respond(UserResource::toArray($user));
    }
}
