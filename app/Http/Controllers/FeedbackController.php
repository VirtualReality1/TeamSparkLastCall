<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Mail\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function submit(FeedbackRequest $request)
    {
        $details = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'mail' => $request->input('mail'),
            'url' => url()->previous()
        ];
        Mail::to(config('feedback.mail'))->send(new Feedback($details));
        return view('static.success');
    }
}
