<?php

namespace App\Http\Controllers;

use App\Repositories\CheckoutRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $request;
    protected $repository;
    protected $stockRepository;

    public function __construct(Request $request, CheckoutRepository $repository, StockRepository $stockRepository)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->stockRepository = $stockRepository;
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
            'id_stock' => 'required|numeric',
            'quantity' => 'required|numeric',
            'date_moved' => 'date',
            'type_moved' => 'required|string'
        ]);

        try {
            $data = $this->request->all();

            $this->findStockById($data['id_stock']);

            $checkout = $this->repository->store($data);

            if (empty($checkout)) {
                throw new \Exception("Não foi possível cadastrar o checkout!", 400);
            }

            return response()->json([
                'code' => 201,
                'message' => "Checkout cadastrado com sucesso!"
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    private function findStockById(int $id)
    {
        $stock = $this->stockRepository->findStockById($id);

        if (
            empty($stock) 
            && !isset($stock)
        ) {
            throw new \Exception("Estoque não encontrado!", 404);
        }
    } 
}
