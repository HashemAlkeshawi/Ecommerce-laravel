<?php

namespace App\Mail;

use App\Models\Item\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyVendor extends Mailable
{
    use Queueable, SerializesModels;
    public $item;

    public function __construct(
        public $vendor_name,
        public $item_id,
    ) {
       $this->item = Item::find($item_id);
    }

 
    public function envelope(): Envelope
    {
        $item_name = $this->item->name;
        return new Envelope(
            subject: "Quantity needed for item: $item_name",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'dashboard.vendor.mail.quantity_drop',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        return [];
    }
}
