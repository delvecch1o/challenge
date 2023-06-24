<?php

namespace App\Services;

use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransferenciaService
{
    public function transferService(Account $account, $value, $depositOrWithdraw, $description)
    {

        if($depositOrWithdraw === true)
        {
        $balanceUser = $account->saldo;
        $newDepositBalance = $balanceUser + $value;  

            $account->update([
            'saldo' =>  $newDepositBalance,
            'description' => $description
            ]) ;

            return [
                'Deposito realizado com sucesso' => $newDepositBalance
            ];
        }
        else
        {
            $balanceUser = $account->saldo; 
            if($value > $balanceUser)
            {
                throw ValidationException::withMessages(
                    ['message' => 
                    'Você não tem saldo suficiente para efetuar esse saque!'
                ]);
            }
            
            $newWithdrawBalance = $balanceUser - $value; 

            $account->update([
                'saldo' =>  $newWithdrawBalance,
                'description' => $description
                ]) ;
    
                return [
                    'Saque realizado com sucesso' => $newWithdrawBalance
                ];
        }
        
    }

}