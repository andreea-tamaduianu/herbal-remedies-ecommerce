<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    // public function AdminContactAll()
    // {
    //     $contacts = Contact::all();
    //     return view('backend.contact.contact_view', compact('contacts'));
    // }

    // public function AdminContactStore(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required',
    //         'phone' => 'required',
    //         'email' => 'required',

    //     ]);



    //     Contact::insert([
    //         'address' => $request->address,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'created_at' => Carbon::now(),

    //     ]);

    //     $notification = array(
    //         'message' => 'Contact inserted successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification);
    // }

    // public function ContactEdit($id)
    // {
    //     $contact = Contact::findOrFail($id);
    //     return view('backend.contact.contact_edit', compact('contact'));
    // }


    // public function ContactUpdate(Request $request, $id)
    // {

    //     Contact::findOrFail($id)->update([
    //         'address' => $request->address,
    //         'phone' => $request->phone,
    //         'email' => $request->email,


    //     ]);

    //     $notification = array(
    //         'message' => 'Contact updated successfully',
    //         'alert-type' => 'info'
    //     );

    //     return redirect()->route('contact.all')->with($notification);
    // } // end mehtod 


    // public function ContactDelete($id)
    // {

    //     Contact::findOrFail($id)->delete();
    //     $notification = array(
    //         'message' => 'Contact deleted successfully',
    //         'alert-type' => 'info'
    //     );

    //     return redirect()->back()->with($notification);
    // }

    public function AdminMailboxAll()
    {
        $messages=Message::all();
        return view('backend.mailbox.inbox_view', compact('messages'));
    }

    public function AdminMessageView($id)
    {
        $message = message::findOrFail($id);
        return view('backend.mailbox.message_view', compact('message'));
    }

    public function NewsletterSubscribersAll(){
        $subscribers = NewsletterSubscriber::all();
        return view('backend.newsletter.subscribers_view', compact('subscribers'));
    }

    public function NewsletterSubscribersDelete($id){
        NewsletterSubscriber::findOrFail($id)->delete();

		$notification = array(
			'message' => 'Subscriber deleted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }

    public function NewsletterSubscribersInactive($id){
        NewsletterSubscriber::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Subscriber is now inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function NewsletterSubscribersActive($id){
        NewsletterSubscriber::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Subscriber is now active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


	
}
