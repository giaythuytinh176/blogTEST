@extends('backend.master')

@section('title')
    Add New Post - Blog TEST
@endsection

@section('content')

    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="activity"></i></div>
                                Add New Post
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <!-- Example DataTable for Dashboard Demo-->
            <form method="post" action="{{ route('admin.store') }}">

                <div class="card mb-4">
                    <div class="card-header">

                        <button type="submit" class="btn btn-primary float-right">Publish</button>

                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                                @if($errors->any())
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <input type="text" class="form-control" name="summary" placeholder="Summary">
                                @if($errors->any())
                                    <div class="alert-danger">{{ $errors->first('summary') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Published at</label>
                                <input type="datetime-local" class="form-control" name="published_at" placeholder="published_at">
                                @if($errors->any())
                                    <div class="alert-danger">{{ $errors->first('published_at') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea id="mytextarea" name="content" cols="100%" rows="25">
                                             {{ old('content') }}
                                </textarea>
                                @if($errors->any())
                                    <p class="alert-danger my-sm-4">{{ $errors->first('content') }}</p>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </main>


@endsection
