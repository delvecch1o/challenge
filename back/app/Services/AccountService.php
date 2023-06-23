<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;



class AccountService
{
    public function createService($nome, $saldo)
    {
        $user = Auth::user();
        $accountData = $user->account()->create([
            'nome' => $nome,
            'saldo' => $saldo,
        ]);
        return $accountData;
    }

    public function showService()
    {
        $user = Auth::user();
        $show = $user->account()->get();

        return $show;
    }

    public function show($id)
    {
        $user = Auth::user();
        $show = $user->account()->find($id);
        return $show; 
    }

    public function updateService(Account $account, $nome, $saldo)
    {
        $account->update([
            'nome' => $nome,
            'saldo' => $saldo,

        ]);

        return [
            'conta' => $account
        ];
    }

    public function destroyService(Account $account)
    {
        $account->delete();
    }
}