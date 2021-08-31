<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateMassages;
use App\Models\DialogMessage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Facades\MessageFacade;

class MessageController extends Controller
{
    public function index(){
        $dialogs = MessageFacade::index();
        return view('frontend.messages.index',compact('dialogs'));
    }

    public function openMessage(Request $request, User $user){
        $parameters = MessageFacade::openMessage($request->all(),$user);
        return view('frontend.messages.index',['dialogs' => $parameters['dialogs'],
            'user' => $parameters['user'],'messages' => $parameters['messages'],'limit' => $parameters['limit']]);
    }

    public function messageSend(ValidateMassages $request,User $user)
    {
        MessageFacade::send($request->validated(),$user);
        return redirect()->route('open-message',['user' => $user]);
    }

    public function download(Request $request, User $user, DialogMessage $message)
    {
        return response()->download(storage_path('app\\public\\message_files\\' . $message->file));
    }
}
