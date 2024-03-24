<?php

namespace App\Transformers;

use App\Models\ChartOfAccounts;
use League\Fractal\TransformerAbstract;

class ChartTransformer extends TransformerAbstract
{
    public function transform(ChartOfAccounts $charts)
    {
        return [
            'id' => $charts->id,
            'name' => $charts->name, 
        ];
    }
}