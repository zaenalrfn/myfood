<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barcode()
    {
        return $this->belongsTo(Barcode::class);
    }

    public function items()
    {
        return $this->HasMany(TransactionItems::class, 'transaction_id');
    }
}
