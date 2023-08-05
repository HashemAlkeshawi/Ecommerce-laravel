<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Mail\NotifyVendor;
use App\Models\Dashboard\Vendor;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send($item_id, $vendor_email)
    {


        if ($vendor_email) {
            $vendor = Vendor::where('email', $vendor_email)->first();
            if ($vendor == null) {

                echo "\033[31m Vendor email not found! \033[0m \n";
            } else {
                echo "\033[33m Sending email to $vendor->email \033[0m \n";
                Mail::to($vendor)->send(new NotifyVendor("$vendor->first_name $vendor->last_name", $item_id));
                echo "\033[32m Email sent to $vendor->email \033[0m  \n";
            }
        } else {
            $vendors = Vendor::join('vendor_items', 'vendors.id', '=', 'vendor_items.vendor_id')->where('vendor_items.item_id', $item_id)->get();
            if (count($vendors) == 0) {
                echo "\033[31m The item has no vendors \033[0m  \n";
            }
            foreach ($vendors as $vendor) {
                echo "\033[33m Sending email to $vendor->email \033[0m  \n";
                Mail::to($vendor)->send(new NotifyVendor("$vendor->first_name $vendor->last_name", $item_id));
                echo "\033[32m Email sent to $vendor->email \033[0m   \n";
            }
        }
    }
}
