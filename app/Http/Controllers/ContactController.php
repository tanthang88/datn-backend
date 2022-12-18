<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Contact;
use App\Models\ProductComment;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::orderBy('id','DESC')->get();
        return view('pages.contact.list', compact('contact'));
    }
    public function dataContact()
    {
        $contacts = Contact::orderBy('id', 'DESC')->get();
        $data['data'] = $contacts;
        return $data;
    }
    public function show($id)
    {
        $contact = Contact::find($id);
        Contact::where('id',$id)->update(['status' =>1]);
        return view('pages.contact.show', compact('contact'));
    }
    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
    }
    public function countNotifications(){
        $contact=Contact::where('status','=',0)->orderBy('id','DESC')->get();
        $order=Bill::where('bill_status','=',0)->orderBy('id','DESC')->get();
        $comment=ProductComment::where('comment_display',0)->where('parent_id',0)->orderBy('id','DESC')->get();
        $data['contact']=['count'=>$contact->count(),'created_date'=>($contact->count()!=0)?strip_tags(diffDatePhp($contact->first()->sent_date)):''];
        $data['order']=['count'=>$order->count(),'created_date'=>($order->count()!=0)?strip_tags(diffDatePhp($order->first()->created_at)):''];
        $data['comment']=['count'=>$comment->count(),'created_date'=>($comment->count()!=0)?strip_tags(diffDatePhp($comment->first()->created_at)):''];
        $data['total']=($contact->count()) + ($order->count()) +($comment->count());
        return $data;
    }
}
