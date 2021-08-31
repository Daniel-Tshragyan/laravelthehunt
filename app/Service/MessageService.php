<?php

namespace App\Service;


use App\Models\Dialog;
use App\Models\DialogMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class MessageService
{

    public function index()
    {
        $id = auth()->user()->id;
        return Dialog::where(['user1_id' => $id])->orWhere(['user2_id' => $id])->get();
    }

    public function openMessage($data, User $user)
    {
        $limit = 5;
        if (isset($data['limit'])) {
            $limit = $data['limit'];
        }
        $messages = [];
        $id = auth()->user()->id;
        $dialogs = Dialog::where(['user1_id' => $id])->orWhere(['user2_id' => $id])->get();
        $dialog = Dialog::where(['user1_id' => $user->id, 'user2_id' => $id])
            ->orWhere(['user2_id' => $user->id])->where([ 'user1_id' => $id])->first();
        if (!is_null($dialog)) {
            $messages = DialogMessage::where(['dialog_id' => $dialog->id])->limit($limit)->get();
            if ($limit >= DialogMessage::where(['dialog_id' => $dialog->id])->count() || $limit == 0) {
                $limit = 0;
            } else {
                $limit += 5;
            }
        }
        return compact('user', 'dialogs', 'messages', 'limit');
    }

    public function send($data, $user)
    {
        $id = auth()->user()->id;
        $data['sender_id'] = $id;
        $dialog = Dialog::where(['user1_id' => $user->id, 'user2_id' => $id])
            ->orWhere(['user2_id' => $user->id])->where([ 'user1_id' => $id])->first();

        if (isset($data['file'])) {
            $fileName = Str::random(10) . '.' . $data['file']->extension();
            $data['file']->storeAs('public/message_files', $fileName);
            $data['file'] = $fileName;
        }
        if (!empty($dialog)) {
            if ($dialog->messages) {
                return $dialog->messages()->save(
                    (new DialogMessage())->fill($data)
                );
            } else {
                $message = new DialogMessage();
                $message->fill($data);
                return $message->save();
            }
        } else {
            $dialog = new Dialog();
            $dialog->fill([
                'user2_id' => $user->id,
                'user1_id' => $id,
            ]);
            $dialog->save();
            $dialog_id = $dialog->id;
            $data['dialog_id'] = $dialog_id;
            $message = new DialogMessage();
            $message->fill($data);
            return $message->save();
        }
    }
}
