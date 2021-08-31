@extends('frontend.messages.layouts.app')
@section('title')
    Messages
@endsection
@section('title1')
    Messages
@endsection
@section('dialogs')
    <ul class="list-item">
    @foreach($dialogs as $dialog)
            <li><a href="
            @if($dialog->user1_id != auth()->user()->id)
                {{ route('open-message',['user' => $dialog->user1_id]) }}
                @else
                {{ route('open-message',['user' => $dialog->user2_id]) }}
            @endif
            ">
                   @if($dialog->user1->id != auth()->user()->id)
                        {{$dialog->user1->name}}
                    @else
                        {{$dialog->user2->name}}
                    @endif
                </a></li>
        @endforeach
    </ul>
@endsection
@section('content1')
    @if(isset($user))
        <div class="col-12 col-lg-7 col-xl-9">
            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                <div class="d-flex align-items-center py-1">
                    <div class="flex-grow-1 pl-3">
                        <strong>{{ $user->name }}</strong>
                    </div>
                </div>
            </div>

            <div class="position-relative">
                <div class="chat-messages p-4" style="height:300px;overflow:auto">
                    @foreach($messages as $message)
                        <div class="alert alert-primary" role="alert"
                             @if($message->sender_id == auth()->user()->id)
                            style="text-align:right;background-color:lawngreen"
                            @endif
                            >
                            {{ $message->text }}
                            @if($message->file)
                                <br>
                            @if($message->isFileImage())
                                <a href="{{ route('download-file',['user' => $user->id,'message' => $message]) }}"><img
                                        src="{{ asset('storage/message_files/'.$message->file) }}" alt="" style="width:50px"></a>
                            @else
                                <a href="{{ route('download-file',['user' => $user->id,'message' => $message]) }}">{{$message->file}}</a>
                            @endif
                            @endif
                </div>
                    @endforeach
                    @if($limit != 0)
                        <p style="text-align: center">
                            <a href="{{ route('open-message',['user' => $user->id,'limit' => $limit]) }}">
                                Load More
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex-grow-0 py-3 px-4 border-top">
                <div class="input-group">
                    <form method="post" action="{{ route('send-message',['user' => $user]) }}" enctype="multipart/form-data">
                        @csrf
                        <input name="text" type="text" class="form-control" placeholder="Type your message" />
                        @if ($errors->has('text'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('text') }}
                            </div>
                        @endif
                        <input type="file" class="form-control" placeholder="" name="file">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>

                </div>
            </div>

        </div>
    @endif
@endsection
