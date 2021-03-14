@extends('frontend.master')

@section('title')
    Blog TEST
@endsection

@section('content')

    <body>

    <!-- Navigation -->
    @include('frontend.nav')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('frontend/img/home-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Blog TEST</h1>
                        <span class="subheading">A Blog by Tam Le</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                @forelse($posts as $post)
                    @if(strtotime($post->published_at) > time())

                        <div class="post-preview">

                            <a href="{{ route('post', ['id'=>$post->id, 'slug'=>$post->slug]) }}">
                                <h2 class="post-title">
                                        <span style="background-color:yellow !important;">
                                        @can('page-user-admin')
                                                {{ $post->published_at < now() ? 'Published' : 'Scheduled' }}
                                                | {{ $post->status == 'hide' ? 'Hide' : 'Show' }} |
                                            @endcan
                                            {{ $post->title }}
                                        </span>
                                </h2>
                                <h3 class="post-subtitle">
                                    {{ substr($post->summary, 0, 33) }} ...
                                </h3>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="#">{{ \App\Models\User::findOrFail($post->user_id)->email }}</a>
                                on {{ $post->published_at }}</p>
                        </div>
                        <hr>
                    @else
                        <div class="post-preview">
                            <a href="{{ route('post', ['id'=>$post->id, 'slug'=>$post->slug]) }}">
                                <h2 class="post-title">
                                    @can('page-user-admin')
                                        {{ $post->published_at < now() ? 'Published' : 'Scheduled' }}
                                        | {{ $post->status == 'hide' ? 'Hide' : 'Show' }} |
                                    @endcan
                                    {{ $post->title }}
                                </h2>
                                <h3 class="post-subtitle">
                                    {{ substr($post->summary, 0, 33) }} ...
                                </h3>
                            </a>
                            <p class="post-meta">Posted by
                                <a href="#">{{ \App\Models\User::findOrFail($post->user_id)->email }}</a>
                                on {{ $post->published_at }}</p>
                        </div>
                        <hr>
                    @endif
                @empty
                    Doesn't have any post here.
            @endforelse
            <!-- Pager -->
                <div class="clearfix">
                    <div><a class="btn btn-primary float-right" href="{{ $posts->nextPageUrl() }}">Older Posts
                            &rarr;</a></div>
                    <div class="float-right">{{ $posts->links( "pagination::bootstrap-4") }}</div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; CodeGym 2021</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('frontend/js/clean-blog.min.js') }}"></script>

    </body>

@endsection
