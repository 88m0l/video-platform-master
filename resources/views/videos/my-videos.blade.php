@extends('layouts.main')

@section('content')
 <div class="mx-4">

    <div class="row justify-content-center">
        <form class="col-md-3 flex justify-content-center" action="{{ route('video.search') }}" method="GET">
            <input type="text" class="form-control mx-sm-3 mb-2" name="term">
            <button type="submit" class="btn btn-secondary mb-2">ابحث</button>
        </form>
    </div>

    <p class="my-4">{{$title}}</p>

    <div class="row">
    @forelse ($videos as $video)
        @if($video->processed)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-icons">
                        @php
                            $hours_add_zero = sprintf('%02d', $video->hours);                            
                        @endphp

                        @php
                            $minutes_add_zero = sprintf('%02d', $video->minutes);                            
                        @endphp

                         @php
                            $seconds_add_zero = sprintf('%02d', $video->seconds);                            
                        @endphp

                        <a href="/videos/{{ $video->id }}">
                            <img src="{{ Storage::url($video->image_path) }}" class="card-img-top" />
                            <time>
                                {{ ($video->hours) > 0 ? $hours_add_zero . ':' : '' }}{{ $seconds_add_zero }} : {{ $minutes_add_zero }}

                            </time>
                            <i class="fas fa-play fa-2x"></i>
                        </a>
                    </div>
                   
                    <a href="/videos/{{ $video->id }}">
                        <div class="card-body">
                            <p class="card-title">{{Str::limit($video->title, 60)}}</p>
                        </div>
                    </a>

                    <div class="card-footer">
                        @foreach ($video->views as $view )
                            <small class="text-muted">
                            <span class="d-block">
                                <i class="fas fa-eye"></i>
                                {{ $view->views_number }} مشاهدة
                            </span>
                        </small>
                        @endforeach

                       

                        <i class="fas fa-clock"></i> <span>{{$video->created_at->diffForHumans()}}</span>

                        @auth
                         @if(!auth()->user()->isBlocked())
                                  @if($video->user_id == auth()->user()->id || auth()->user()->isAdmin() || auth() ->user()->isSuperAdmin())

                            <form method="POST" action="{{ route('videos.destroy', $video->id) }}"
                             onsubmit="return confirm('هل أنت متأكد من حذف مقطع الفيديو؟')"    
                            >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="float-left">
                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                            </button>

                            </form>

                            <a href="{{ route('videos.edit', $video->id) }}">
                                <button type="button" class="float-left">
                                    <i class="far fa-edit text-success fa-lg ms-3"></i>
                                </button>
                            </a>

                            @endif

                         @endif
                          
                        @endauth
                    </div>
                </div>

            </div>

        @endif
        
    @empty
        <div class="mx-auto col-8">
            <div class="alert alert-primary text-center" role="alert">
                لا يوجد فيديوهات
            </div>
        </div>
    @endforelse
    </div>
 </div>
@endsection
