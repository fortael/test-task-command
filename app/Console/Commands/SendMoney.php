<?php

namespace App\Console\Commands;

use App\Helpers\TransactionHelper;
use App\User;
use Illuminate\Console\Command;

class SendMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-money {from} {recipient} {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a transaction';


    /** @var TransactionHelper */
    private $transaction;

    /**
     * Create a new command instance.
     *
     * @param TransactionHelper $helper
     */
    public function __construct(TransactionHelper $helper)
    {
        $this->transaction = $helper;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $validation = validator($this->arguments(), [
            'from'      => 'string',
            'recipient' => 'string',
            'amount'    => 'numeric'
        ]);

        if ($validation->fails()) {
            $this->error($validation->errors()->first());
            return;
        }

        $from = User::where('name', $this->argument('from'))->first();

        if ($from === null) {
            $this->error("User {$this->argument('from')} doesn't exists.");
            return;
        }

        $recipient = User::where('name', $this->argument('recipient'))->first();

        if ($recipient === null) {
            $this->error("User {$this->argument('recipient')} doesn't exists.");
            return;
        }

        try {
            $this->transaction->make($from, $recipient, (float)$this->argument('amount'));
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('Done');
        return;
    }
}
