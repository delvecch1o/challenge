<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransferenciaService;
use App\Models\User;
use App\Models\Account;
use App\Http\Requests\TransferenciaRequest;

class TransferenciaController extends Controller
{

    private TransferenciaService $transferenciaService;

    public function __construct(TransferenciaService $transferenciaService)
    {
        $this->transferenciaService = $transferenciaService;
    }
  

    public function transfer(TransferenciaRequest $request, Account $account)
    {
        $saldo = $this->transferenciaService->transferService(
            $account,
            ...array_values(
                $request->only([
                    'saldo',
                    'depositOrWithdraw',
                    'description'
                ])
            )
        );
        return response()->json([
            'status' => $saldo,
            
        ]);
        
    }

}
