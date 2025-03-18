<?php

namespace App\Observers;

use App\Models\Transaksi;
use App\Models\Pendaftar;

class TransaksiObserver
{
    /**
     * Handle the Transaksi "created" event.
     */
    public function created(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "updated" event.
     */
    public function updated(Transaksi $transaksi): void
    {
        if ($transaksi->isDirty('transaction_status')) {
            Pendaftar::where('id_pendaftaran', $transaksi->id_pendaftaran)
                ->update(['status_pembayaran' => $transaksi->transaction_status]);
        }
    }

    /**
     * Handle the Transaksi "deleted" event.
     */
    public function deleted(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "restored" event.
     */
    public function restored(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "force deleted" event.
     */
    public function forceDeleted(Transaksi $transaksi): void
    {
        //
    }
}
