<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContaPagarService;
use App\Models\Contapagar;
use App\Http\Requests\ContaPagarRequest;

class ContaPagarController extends Controller
{
    private ContaPagarService $contaPagarService;
    
    public function __construct(ContaPagarService $contaPagarService)
    {
        $this->contaPagarService = $contaPagarService;
    }

    public function create(ContaPagarRequest $request)
    {
        $data = $this->contaPagarService->createService(
            ...array_values(
                $request->only([
                    'descricao',
                    'valor',
                ])
            )
        );
        return response()->json([
            'Dados do Boleto' => $data,
            'message' => 'Boleto criado com sucesso!'
        ]);
    }

    public function show()
    {
        $show = $this->contaPagarService->showService();
        return response()->json([
            'show' => $show
        ]);
    }

    public function showDetails($id)
    {
        $show = $this->contaPagarService->show($id);
        return response()->json([
            'showDetails' => $show
        ]);
    }

    public function update(ContaPagarRequest $request, Contapagar $contapagar)
    {
        $data = $this->contaPagarService->updateService(
            $contapagar,
            ...array_values(
                $request->only([
                    'descricao',
                    'valor',
                ])
            )
        );
        return response()->json([
            'contapagar' => $data['contapagar'],
            'message' => 'Boleto Atualizado com sucesso!'
        ]);
    }

    public function destroy(Contapagar $contapagar)
    {
        $this->contaPagarService->destroyService($contapagar);
        return response()->json([
            'message' =>  'Boleto excluido com sucesso!'
        ]);
    }
}
