<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class Admin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $count_customer = DB::table('customers')
            ->select('country', DB::raw('count(*) as total_users'))
            ->groupBy('country')
            ->get();
        return $this
            ->to(env('ADMIN_EMAIL'))
            ->subject("Registro App")
            ->view('emails.admin', ["count_customer" => $count_customer]);
    }
}
