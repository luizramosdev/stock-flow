<?php

namespace App\Http\Controllers;

use App\Repositories\StockRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, StockRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function index() : JsonResponse
    {
        $data = $this->repository->getAll();

        $data = !empty($data) ? $data : [];

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function store(): JsonResponse
    {
        // Validar os campos recebidos.
        $this->request->validate([
            'id_product' => 'required|numeric',
            'quantity' => 'required|numeric',
            'type_moved' => 'required|string'
        ]);

        try {
            $stock = $this->repository->store($this->request->all());

            if (empty($stock)) {
                throw new \Exception("Não foi possível cadastrar o check-in!", 400);
            }

            return response()->json([
                'code' => 201,
                'message' => "Check-in cadastrado com sucesso!"
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
