<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required|min:3|max:100',
                'email' => 'required|email',
                'message' => 'required|min:20',
            ],
            [
                'name.required' => 'Il campo nome é obbligatorio',
                'name.min' => 'Il campo nome deve contenere almeno :min caratteri',
                'name.max' => 'Il campo nome non puó contenere piú di :max caratteri',
                'email.required' => 'Il campo E-mail é obbligatorio',
                'email.email' => 'Il formato del campo E-mail non é corretto',
                'message.required' => 'Il campo messaggio é obbligatorio',
                'message.min' => 'Il campo messaggio deve contenere almeno :min caratteri'
            ]
        );

        if($validator->fails()){
            $succes = false;
            $errors = $validator->errors();
            return response()->json(compact('succes', 'errors'));
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($new_lead));

        $succes = true;
        return response()->json(compact('succes'));
    }
}
