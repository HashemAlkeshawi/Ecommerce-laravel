<?php

namespace App\Console\Commands;

use App\Http\Controllers\Actions\SendEmailController;
use Illuminate\Console\Command;

class EmailVendor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailvendor:send {item_id} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SendEmailController $sendEmailcontroller)
    {
        //

        $email = $this->option('email');
        $item_id = $this->argument('item_id');
        $sendEmailController = new  SendEmailController;

        $sendEmailController->send($item_id, $email);

        // echo "on Send for all";
    }
}
