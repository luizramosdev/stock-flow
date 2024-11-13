<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, ProductRepository $productRepository) {
        $this->request = $request;
        $this->repository = $productRepository;
    }

    public function index()
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
            // Busca produto
            $user = $this->repository->findProductById($id);

            if(!$user) throw new \Exception('Produto não encontrado', 404);

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

        $this->request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'category' => 'required|string',
            'value' => 'required|numeric'
        ]);

        try {
            $data = $this->request->all();

            $product = $this->repository->store($data);

            if (empty($product)) {
                throw new \Exception("Não foi possível cadastrar o produto!", 400);
            }

            return response()->json([
                'code' => 201,
                'message' => "Produto cadastrado com sucesso!"
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
