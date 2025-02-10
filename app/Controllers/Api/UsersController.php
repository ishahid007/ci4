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

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->userValidation = new UserValidation();
    }

    /**
     * Get all users
     */
    public function index(): ResponseInterface
    {
        $users = $this->model->paginate(10);

        // Use the Resource
        return $this->respond(UserResource::collection($users));
    }

    /**
     * Create a new user
     */
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

    /**
     * Show a single user
     *
     * @param int|null $id
     */
    public function show($id = null): ResponseInterface
    {
        $user = $this->model->find($id);
        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        return $this->respond(UserResource::toArray($user));
    }
}
