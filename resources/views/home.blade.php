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
                    </div>

                    <a class="channel-img" href="{{ route('main.channels.videos', $video->user) }}">
                        <img src="{{ $video->user->profile_photo_url }}" class="rounded-full my-2 ms-3 d-inline" width="30" />
                        <span class="card-text">{{$video->user->name}}</span>
                    </a>

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
