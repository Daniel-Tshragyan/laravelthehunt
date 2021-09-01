@extends('admin.layouts.app')

@section('title')
    All Tags
@endsection
@section('content')
    {{ Breadcrumbs::render('tag') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1> All Tags</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($pagination->sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('job.index',['order_by' => $key, 'how' => $val]) }}">
                        @if($key == 'company_id')
                            company
                        @elseif($key == 'category_id')
                            category
                        @else
                            {{$key}}
                        @endif
                    </a>
                </td>
            @endforeach()
            <td>
                Actions
            </td>
        </tr>
        <tr>
            <form
                action="{{ route('tag.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td style="width:80px">
                    <input class="form-control" value="{{ $pagination->searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $pagination->searched['title'] }}" type="text" name="title">
                </td>

                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>
        </tr>
        </thead>
        <tbody>
        @foreach($pagination->tags as $tag)
            <tr>
                <td>
                    {{ $tag->id }}
                </td>
                <td>
                    {{$tag->title}}
                </td>
                <td>
                    <a title="Show" style="margin:5px" href="{{ route('tag.show',['tag' => $tag]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('tag.edit',['tag' => $tag]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('tag.destroy',['tag' => $tag]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Remove" style="border:none;background-color:transparent" type="submit">
                            <i style="color: red" class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pagination->tags->links() }}

    <a href="{{ route('tag.create') }}">
        <button class="btn btn-success">
            Create New
        </button>
    </a>
    <br>

@endsection
