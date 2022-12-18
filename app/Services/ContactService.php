<?php

namespace App\Services;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function __construct()
    {
    }
    /**
     * createContact
     *
     */
    public function createContact(ContactRequest $request)
    {
        $customer_id = null;
        if (($request->has('customer_id'))) {
            $customer_id = $request->customer_id;
        }
        $contact =  Contact::create([
            'customer_id' => $customer_id,
            'customer_name' => $request->customer_name,
            'subject' => $request->subject,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request->content,
            'sent_date' => date('Y-m-d H:i:s'),
            'status' => 0
        ]);
        return $contact;
    }
}
