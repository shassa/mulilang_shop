<?php

namespace App\Listeners;

use App\Events\AddProduct;
use App\Mail\ProductCreated;
use App\Newsletter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewsLetterNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddProduct  $event
     * @return void
     */
    public function handle(AddProduct $event)
    {
        $users=Newsletter::all();
        foreach($users as $user) {
            Mail::to($user)->send(new ProductCreated);
         }
    }
}
