@extends('frontend.company.layouts.app')
@section('title')
    Manage Applications
@endsection
@section('content1')

    <div class="alerts-list">
        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="row justify-content-around">
            @foreach($sorts as $key => $val)
                @if($key != 'company_id')
                    <div style="margin:0 0 0 10px;padding:0; " class="col-lg-3 col-md-3 col-xs-12">
                        <a style="margin:10px" href="{{ route('manage-applications',['order_by' => $key, 'how' => $val]) }}">
                            @if($key == 'category_id')
                                category
                            @else
                                {{$key}}
                            @endif
                        </a>
                    </div>
                @endif

            @endforeach()
            <div style="margin:0 0 0 10px" class="col-lg-3 col-md-3 col-xs-12">
                Actions
            </div>
        </div>

        <form
            action="{{ route('manage-applications',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
            <div class="alerts-list d-flex justify-content-around">
                @csrf
                <div style="margin:0 0 0 10px;padding:0;" class="col-lg-3 col-md-3 col-xs-12">
                    <input class="form-control" placeholder="Id" value="{{ $searched['id'] }}" type="number" name="id">
                </div>
                <div style="margin:0 0 0 10px;padding:0;" class="col-lg-3 col-md-3 col-xs-12">
                    <input class="form-control" placeholder="Text" value="{{ $searched['text'] }}" type="text"
                           name="text">
                </div>
                <div style="margin:0 0 0 10px;padding:0;" class="col-lg-3 col-md-3 col-xs-12">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </div>
        </form>
        @foreach($applications as $application)
            <div class="notification-item">
                <div class="text-left">
                    <p style="margin-right:10px;display:inline-block">{{ $application->id }}</p>
                    <p style="display:inline-block">{{ $application->text }}.</p>
                    <br>
                    <span class="time"><i class="lni-alarm-clock"></i>{{ $application->created_at }}</span>
                </div>
            </div>
    @endforeach

    {{ $applications->links() }}
@endsection
