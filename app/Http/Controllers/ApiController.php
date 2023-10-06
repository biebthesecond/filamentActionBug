<?php


namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiController
{
    public function __invoke(Request $request)
    {
        $rules = [
            'email_receiver' => 'email|required',
            'subject' => 'max:255',
            'content' => 'nullable',
            'expires_at' => 'date|required',
        ];

        $messages = [
            'email_receiver.required' => 'A email is required.',
            'email_receiver.email' => 'A valid email is required.',
            'subject.max' => 'Subject may not be longer than 255 characters.',
            'expires_at.required' => 'A expiration date is required.',
            'expires_at.date' => 'A valid date is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json(['status' => 'error', 'errors' => $errors])->setStatusCode(400);
        }

        $data = [];
        $data['email_receiver'] = $request->input('email_receiver');
        $data['subject'] = $request->input('subject');
        $data['content'] = $request->input('content');
        $data['expires_at'] = Carbon::createFromTimeString($request->input('expires_at'));
        $data['files'] = $request->allFiles();

        $message = app(SaveMessageAction::class)($request->user(), $data);

        Mail::send(new MessageSend($message));
        return ['status' => 'succes'];
    }
}
