<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\Invoice;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function afterCreate(): void
    {
        $payment = $this->record;
        $invoice = Invoice::find($payment->invoice_id);
        if (! $invoice) {
            return;
        }

        $invoice->amount_paid = (float) $invoice->payments()->sum('amount');
        $invoice->status = $invoice->amount_paid >= $invoice->total
            ? 'paid'
            : ($invoice->amount_paid > 0 ? 'partial' : $invoice->status);
        $invoice->save();
    }
}
