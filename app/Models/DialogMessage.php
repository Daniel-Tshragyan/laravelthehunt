<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class DialogMessage extends Model
{
    protected $fillable = [
        'text',
        'file',
        'dialog_id',
        'sender_id',
    ];

    public function dialog()
    {
        return $this->belongsTo(Dialog::class, 'dialog_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function isFileImage()
    {
       $file  =  explode('.',$this->file);
       $ext = Arr::last($file);
       if ($ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
           return true;
       }
       return false;
    }
}
