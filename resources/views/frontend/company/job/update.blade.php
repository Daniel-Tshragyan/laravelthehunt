@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Update Job</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-xs-12">
                    <div class="post-job box">
                        <h3 class="job-title">Post a new Job</h3>
                        <form class="form-ad" action="{{route('front-job.update',['front_job' => $job])}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="company_id" value="{{ auth()->id() }}">
                            <div class="form-group">
                                <label class="control-label" >Job Title</label>
                                <input type="text" value="{{ $job->title }}" class="form-control" name="title" placeholder="Write job title" >
                            </div>
                            @if ($errors->has('title'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label">Location </label>
                                <input type="text" value="{{ $job->location }}" class="form-control" name="location" placeholder="e.g.London">
                            </div>
                            @if ($errors->has('location'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if($category->id == $job->category->id)
                                                        selected="selected"
                                                    @endif
                                                >{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('category_id'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Job Tags</label>
                                <select class="tags1 form-control" name="job_tags[]" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                                @if(in_array($tag->id, $job->tags->pluck('id')->toArray())))
                                                selected="selected"
                                            @endif
                                        >{{ $tag->title }}</option>
                                    @endforeach
                                </select>
                                <p class="note">Comma separate tags, such as required skills or technologies, for this job.</p>
                            </div>
                            @if ($errors->has('job_tags'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('job_tags') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" value="{{ $job->description }}" id="" cols="30" rows="10" class="form-control">{{ $job->description }}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label">Application email / URL</label>
                                <input name="url" value="{{ $job->url }}" type="text" class="form-control" placeholder="Enter an email address or website URL">
                            </div>
                            @if ($errors->has('url'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('url') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Closing Date</label>
                                <input type="date" class="form-control"value="{{ $job->closing_date }}" name="closing_date">
                            </div>
                            @if ($errors->has('closing_date'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('closing_date') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Price</label>
                                <input type="number" value="{{ $price }}"  class="form-control" name="price">
                            </div>
                            @if ($errors->has('price'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif

                            <button type="submit" class="btn btn-success">Update Job</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
