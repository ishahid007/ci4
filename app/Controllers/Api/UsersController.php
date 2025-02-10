<?php

namespace App\Controllers\Api;

use App\Resources\UserResource;
use App\Validations\UserValidation;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

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
     *
     * @Cache(time=60, group="users")
     */
    public function index(): ResponseInterface
    {
        $response = cache()->remember('users', 60, static function () {
            $users = model('App\Models\UserModel')->paginate(10);

            return UserResource::collection($users);
        });

        return $this->respond($response);
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
        $this->model->insert($validatedData);

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
        // Check if the user is not found, return a 404 response
        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        return $this->respond(UserResource::toArray($user));
    }
}
