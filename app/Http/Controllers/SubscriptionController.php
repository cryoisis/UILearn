<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Upgrade ke Pro.
     * CATATAN: ini simulasi checkout. Sambungkan ke payment gateway
     * (Midtrans, Xendit, dsb.) dan panggil forceFill() hanya setelah pembayaran terkonfirmasi.
     */
    public function upgrade(Request $request): RedirectResponse
    {
        $request->user()->forceFill(['plan' => 'pro'])->save();

        return redirect()->route('subscription')->with('status', 'upgraded');
    }

    public function downgrade(Request $request): RedirectResponse
    {
        $request->user()->forceFill(['plan' => 'free'])->save();

        return redirect()->route('subscription')->with('status', 'downgraded');
    }
}
