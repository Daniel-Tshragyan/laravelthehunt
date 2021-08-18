@extends('admin.layouts.app')
@section('title')
    All Categories
@endsection
@section('content')
    {{ Breadcrumbs::render('category') }}
    <h1>All Categories</h1>

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('category.index',['order_by' => $key, 'how' => $val]) }}">{{$key}}
                    </a>
                </td>
            @endforeach()
            <td>Image</td>
            <td>Actions</td>
        </tr>
        <tr>
            <form action="{{ route('category.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td>
                    <input class="form-control" value="{{ $searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['title'] }}" type="text" name="title">
                </td>
                <td>
                    <input name="jobs_count" class="form-control" value="{{ $searched['jobs_count'] }}" name="jobs_count" type="number">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['sort'] }}" type="number" name="sort">
                </td>
                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->id }}
                </td>
                <td>
                    <a href="{{ route('category.show',['category' =>$category]) }}">
                        {{ $category->title }}
                    </a>
                </td>
                <td>
                    {{ $category->jobs_count }}
                </td>
                <td>
                    {{ $category->sort }}
                </td>
                <td>
                    <img src="{{ asset('storage/categories_images/'.$category->image) }}" width="80px" alt="">
                </td>
                <td>
                    <a title="Show" style="margin:5px" href="{{ route('category.show',['category' => $category]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('category.edit',['category' => $category]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('category.destroy',['category' => $category]) }}" method="post">
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

    {{ $categories->links() }}
    <br>
    <a href="{{ route('category.create') }}">
        <button class="btn btn-success">
            Create New
        </button>
    </a>

@endsection
