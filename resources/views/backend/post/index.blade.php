@extends('backend.master')

@section('title')
    Posts - Blog TEST
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
                                List Posts
                            </h1>
                            <div class="page-header-subtitle">Here is our list posts</div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">
                            <button class="btn btn-white p-3" id="reportrange">
                                <i class="mr-2 text-primary" data-feather="calendar"></i>
                                <span></span>
                                <i class="ml-1" data-feather="chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <!-- Example DataTable for Dashboard Demo-->
            <div class="card mb-4">
                <div class="card-header">Private Blog TEST</div>
                <div class="card-body">
                    <div class="datatable"><!--  id="dataTable" -->
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Author</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Author</th>
                                <th>Date</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($posts as $k => $post)
                                <tr>
                                    <td>
                                        {{ $post->title }}
                                        <div class="row-actions">
                                            <span class="edit"><a href="{{ route('admin.edit', ['id'=>$post->id, 'slug'=>$post->slug])  }}" aria-label="Edit {{ $post->title }}">Edit</a></span>
                                            |
                                            <span class="trash">
                                                <a href="{{ route('admin.destroy', $post->id) }}" class="submitdelete" onclick="return confirm('Do you want to delete it?')" aria-label="Move {{ $post->title }} to the Trash">Trash</a>
                                            </span>
                                            @if(($post->is_published == 1 && $post->status == 'show') || (\Illuminate\Support\Facades\Auth::user()->role == 1))
                                                |
                                                <span class="view"><a href="{{ route('post', ['id'=>$post->id, 'slug'=>$post->slug])  }}" aria-label="View {{ $post->title }}" target="_blank">View</a></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ substr($post->summary, 0, 33) }} ...</td>
                                    <td>
                                        {{ \App\Models\User::findOrFail($post->user_id)->email }}
                                    </td>
                                    <td>
                                        <div>
                                            @php
                                                if (strtotime($post->published_at) > time()) {
                                                   echo 'Scheduled';
                                                }
                                                else {
                                                    echo 'Published';
                                                }
                                            @endphp
                                            | {{ $post->status == 'show' ? 'Show' : 'Hide' }}
                                        </div>
                                        <div>{{ $post->published_at }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Not found data.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div style="float: right;">{{ $posts->links( "pagination::bootstrap-4") }}</div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
