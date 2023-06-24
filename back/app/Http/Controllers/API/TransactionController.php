<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use App\Models\Contapagar;
use App\Models\Account;


class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function transaction(TransactionRequest $request,Contapagar $contapagar, Account $account)
    {
      $transaction = $this->transactionService->makeTransaction(
        $contapagar,$account,
          ...array_values(
              $request->only([
                  'is_liquidation',
              ])
          )
        );

        return response()->json([
          'status' => $transaction
      ]);
        

    }
}