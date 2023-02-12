<?php

namespace App\Http\Controllers;

use App\Events\LogSentEmails;
use App\Mail\Email;
use App\Persons;
use App\Rules\PhoneNumberRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class PersonController extends Controller
{

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'phone' => ['required', new PhoneNumberRule()],
            'message' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message
        ];

        $person = new Persons();
        $person->email = $request->email;
        $person->name = $request->name;
        $person->phone = $request->phone;
        $person->message = $request->message;

        try {
            Mail::to($person->email)->send(new Email($data));
        } catch (\Exception $e) {
            $person->status = false;

            Event::dispatch(new LogSentEmails($person));
            $person->save();
            return back()->with('error', 'Sorry! Please try again latter');
        }
        $person->status = true;
        Event::dispatch(new LogSentEmails($person));
        $person->save();
        return back()->with('success', 'Check your inbox');
    }
}
