<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateMassages;
use App\Models\DialogMessage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Service\MessageService;

class MessageController extends Controller
{
    public function index(MessageService $messageService)
    {
        $dialogParameters = $messageService->getAllDialogs();
        return view('frontend.messages.index', ['parameters' => $dialogParameters,]);
    }

    public function openMessage(Request $request, MessageService $messageService, User $user)
    {
        $dialogParameters = $messageService->getActiveDialog($request->all(), $user);

        return view('frontend.messages.index', ['parameters' => $dialogParameters]);
    }

    public function messageSend(ValidateMassages $request, MessageService $messageService, User $user)
    {
        $messageService->send($request->validated(), $user);
        return redirect()->route('open-message', ['user' => $user]);
    }

    public function download(Request $request, User $user, DialogMessage $message)
    {
        return response()->download(storage_path('app/public/message_files/' . $message->file));
    }
}
