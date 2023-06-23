<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AccountUpdateRequest;

class AccountController extends Controller
{
    private AccountService $accountService;
    
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function create(AccountRequest $request)
    {
        $data = $this->accountService->createService(
            ...array_values(
                $request->only([
                    'nome',
                    'saldo'
                ])
            )
        );
        return response()->json([
            'Dados da Conta' => $data,
            'message' => 'Conta criada com sucesso!'
        ]);
    }

    public function show()
    {
        $show = $this->accountService->showService();
        return response()->json([
            'show' => $show
        ]);
    }

    public function showDetails($id)
    {
        $show = $this->accountService->show($id);
        return response()->json([
            'showDetails' => $show
        ]);
    }

    public function update(AccountUpdateRequest $request, Account $account)
    {
        $data = $this->accountService->updateService(
            $account,
            ...array_values(
                $request->only([
                    'nome',
                    'saldo'
                ])
            )
        );
        return response()->json([
            'conta' => $data,
            'message' => 'Dados da conta Atualizado com sucesso!'
        ]);
    }

    public function destroy( Account $account)
    {
        $this->accountService->destroyService($account);
        return response()->json([
            'message' =>  'Dados da conta excluido excluidos com sucesso!'
        ]);
    }
}