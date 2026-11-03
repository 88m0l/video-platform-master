@extends('layouts.main')

@section('content')
 <div class="mx-4">
    @if($videos->count() > 0)
    <div class="row justify-content-center">
         <form method="POST"
                class="form-inline col-md-4 flex justify-content-center"
               action="{{ route('history.destroyAll') }}"
                             onsubmit="return confirm('هل أنت متأكد من حذف سجل المشاهدة بالكامل؟')"    
                            >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-secondary mb-2">
                                حذف السجل
                            </button>

     </form>

     <hr />

     </div>

    @endif

    <br />

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
                            <form method="POST"
                             action="{{ route('history.destroy', $video->pivot->id) }}"
                             onsubmit="return confirm('هل أنت متأكد من حذف مقطع الفيديو؟')"    
                            >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="float-left">
                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                            </button>

                            </form>
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
