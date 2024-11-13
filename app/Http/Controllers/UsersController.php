<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, UserRepository $userRepository) 
    {
        $this->request = $request;
        $this->repository = $userRepository;
    }

    public function index(): JsonResponse
    {
        $data = $this->repository->getAll();

        $data = !empty($data) ? $data : [];

        return response()->json([
            'code' => 200,
            'data' => $data
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        try {
            // Busca o usuário
            $user = $this->repository->findUserById($id);

            if(!$user) throw new \Exception('Usuário não encontrado', 404);

            return response()->json([
                'code' => 200,
                'data' => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(): JsonResponse
    {
        // Válida os campos recebidos.
        $this->request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        try {
            $data = $this->request->all();

            // Verifica se o e-mail já foi cadastrado.
            $this->checkEmailExits($data['email']);

            $user = $this->repository->store($this->request->all());

            if (empty($user)) {
                throw new \Exception("Não foi possível cadastrar o usuário!", 400);
            }

            return response()->json([
                'code' => 201,
                'message' => "Usuário cadastrado com sucesso!"
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    private function checkEmailExits(string $email): void {
        $emailExists = $this->repository->findUserByEmail($email);

        if (
            !empty($emailExists)
            && isset($emailExists)
        ) {
            throw new \Exception("O e-mail informado já está cadastrado", 400);
        }
    }
}
