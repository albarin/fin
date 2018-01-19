<?php

namespace App\Jobs;

use App\Account;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Facades\Excel;

class ProcessTransactionsDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $document;
    private $account;

    public function __construct(string $document, int $accountId)
    {
        $this->document = document_path($document);
        $this->account = Account::find($accountId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::load($this->document, function ($reader) {
            $reader->formatDates(false);

            foreach ($reader->get() as $line) {
                $this->importTransaction(
                    $this->prepareTransaction($line)
                );
            }
        });

        $this->removeDocument();
    }

    private function importTransaction(array $transaction)
    {
        $t = new Transaction($transaction);

        $t->user()->associate($this->account->user);
        $t->account()->associate($this->account);
        $t->save();
    }

    private function prepareTransaction(CellCollection $line)
    {
        $line = array_values($line->toArray());

        return [
            'name' => $line[0],
            'description' => $line[3],
            'amount' => str_replace(',', '', $line[4]),
            'date' => Carbon::createFromFormat('m/d/Y', $line[1])->format('d/m/Y'),
        ];
    }

    private function removeDocument()
    {
        unlink(full_document_path($this->document));
    }
}
