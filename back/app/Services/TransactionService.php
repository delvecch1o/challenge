<?php

namespace App\Services;


use App\Models\Contapagar;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;

class TransactionService
{
    public function  makeTransaction(Contapagar $contapagar,Account $account, $is_liquidation)
    {
       
        $user = Auth::user();
        $billPayIn = $user->contapagar->paga_em = Carbon::now();
        $guardIdBillPay = $contapagar->id;
        $guardIdAccountUser = $account->id;
       
        $payerBank =  $account;
        $payeeProvider = $contapagar;

        
        if($payerBank->saldo < $payeeProvider->valor)
        {
            throw ValidationException::withMessages(
                ['message' => 
                'Você não tem saldo suficiente para fazer esta transação',
                'O valor da sua conta é de => ' .$payeeProvider->valor,
                'Saldo da conta bancaria => ' .$payerBank->saldo 
            ]);
        }

        if($payeeProvider->valor == 0)
        {
            throw ValidationException::withMessages(
                ['message' => 
                'Esta conta ja foi paga',
                
            ]);
        }
        
        if($is_liquidation == false)
        {
            throw ValidationException::withMessages(
                ['message' => 
                'Esta transação foi encerrada',
                
            ]); 
        }

        $payload =[
            'user_id' => $user->id,
            'conta_pagar_id' => $guardIdBillPay,
            'accounts_id' =>  $guardIdAccountUser,
            'is_liquidation' => $is_liquidation
        ];

        $transactionResult = DB::transaction(function () use ($payload,  $payerBank,  $payeeProvider){

            $transaction = Transaction::create($payload);

            $payerBank->saldo -= $payeeProvider->valor;
            $payerBank->save();
            
            $payeeProvider->valor -= $payeeProvider->valor;
            $payeeProvider->save();
           

            return $transaction;
        });


        return $transactionResult;

    
    }


}