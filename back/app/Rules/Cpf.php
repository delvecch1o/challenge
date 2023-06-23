<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
   
    public function passes($attribute, $value)
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $value);
        
        if(strlen($cpf) != 11){
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($tamanho = 9; $tamanho < 11; $tamanho++) {
            for ($digito = 0, $contador = 0; $contador < $tamanho; $contador++) {
                $digito += $cpf[$contador] * (($tamanho + 1) - $contador);
            }
            $digito = ((10 * $digito) % 11) % 10;
            if ($cpf[$contador] != $digito) {
                return false;
            }
        }

        return true;
    }

    
    public function message()
    {
        return 'CPF inválido.';
    }
}