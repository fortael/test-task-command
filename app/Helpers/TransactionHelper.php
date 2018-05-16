<?php

namespace App\Helpers;

use App\User;
use Illuminate\Support\Facades\DB;

class TransactionHelper
{
    /**
     * @param User $from
     * @param User $to
     * @param float $amount
     * @throws \Exception
     */
    public function make(User $from, User $to, float $amount) {
        if ($from->balance - $amount < 0) {
            throw new \Exception("User $from->name have not enough money.");
        }

        DB::transaction(function () use ($from, $to, $amount) {
            $from->balance = $from->balance - $amount;
            $to->balance = $to->balance + $amount;

            $from->save();
            $to->save();
        });
    }
}