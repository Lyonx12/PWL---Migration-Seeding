<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'return_models';

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class);
    }

    protected $fillable = [
        'loan_detail_id',
        'charge',
        'amount'
    ];
}
