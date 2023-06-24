<?php

namespace App\Services;

use App\Models\Contapagar;
use Illuminate\Support\Facades\Auth;



class ContaPagarService
{
    public function createService($descricao, $valor)
    {
        $user = Auth::user();
        $ticketData = $user->contaPagar()->create([
            'descricao' => $descricao,
            'valor' => $valor,
        ]);
        return $ticketData;
    }

    public function showService()
    {
        $user = Auth::user();
        $show = $user->contaPagar()->get();

        return $show;
    }

    public function show($id)
    {
        $user = Auth::user();
        $show = $user->contaPagar()->find($id);
        return $show; 
    }

    public function updateService(Contapagar $contapagar, $descricao, $valor)
    {
        $contapagar->update([
            'descricao' => $descricao,
            'valor' => $valor,
        ]);

        return [
            'contapagar' => $contapagar
        ];
    }

    public function destroyService(Contapagar $contapagar)
    {
        $contapagar->delete();
    }
}
