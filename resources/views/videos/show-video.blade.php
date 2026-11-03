@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="mx-auto col-9">
                <input type="hidden" id="videoId" value="{{ $video->id }}" />
                <div class="vidcontainer mb-4">
                    @foreach ($video->convertedvideos as $video_converted )
                        <video autoplay controls id="videoPlayer"
                         style="{{ $video->Longitudinal == '0' ? 'width: 100%; height: 90%' : 'width: 900px; height: 510px' }}"
                        >
                            @if ($video->quality == 1080)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_1080) }}" 
                                    type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_1080) }}" 
                                    type="video/mp4">
                            @elseif ($video->quality == 720)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_720) }}" 
                                    type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_720) }}" 
                                    type="video/mp4">

                            @elseif ($video->quality == 480)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_480) }}" 
                                    type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_480) }}" 
                                    type="video/mp4">
                            @elseif ($video->quality == 360)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_360) }}" 
                                    type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_360) }}" 
                                    type="video/mp4">

                            @else
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_240) }}" 
                                    type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_240) }}" 
                                    type="video/mp4">
                            @endif
                        </video>
                    @endforeach
                </div>

                <select id="qualityPick">
                    <option value="1080" {{ $video->quality == 1080 ? 'selected' : '' }} {{ $video->quality < 1080 ? 'hidden': '' }}>
                        1080p
                    </option>

                    <option value="720" {{ $video->quality == 720 ? 'selected' : '' }} {{ $video->quality < 720 ? 'hidden': '' }}>
                        720p
                    </option>

                    <option value="480" {{ $video->quality == 480 ? 'selected' : '' }} {{ $video->quality < 480 ? 'hidden': '' }}>
                        480p
                    </option>

                     <option value="360" {{ $video->quality == 360 ? 'selected' : '' }} {{ $video->quality < 360 ? 'hidden': '' }}>
                        360p
                    </option>


                    <option value="240" {{ $video->quality == 240 ? 'selected' : '' }}>
                        240p
                    </option>

                </select>

                <div class="title mt-3">
                    <h5>
                        {{ $video->title }}
                    </h5>
                </div>

                <div class="interaction text-center mt-5">
                    <a href="#" class="like ml-3">
                        @if($userLike)
                            @if($userLike->like == 1)
                                <i class="far fa-thumbs-up fa-2x liked"></i><span id="likeNumber" class="mx-2">{{$countLike}}</span>
                            @else
                                <i class="far fa-thumbs-up fa-2x"></i><span id="likeNumber" class="mx-2">{{$countLike}}</span>
                            @endif

                        @else 
                            <i class="far fa-thumbs-up fa-2x"></i><span id="likeNumber" class="mx-2">{{$countLike}}</span>
                        @endif
                    </a>

                    <a href="#" class="like mr-3">
                        @if($userLike)
                            @if($userLike->like == 0)
                                <i id="like_down" class="far fa-thumbs-down fa-2x liked"></i><span id="dislikeNumber" class="mx-2">{{$countDislike}}</span>
                            @else
                                <i id="like_down" class="far fa-thumbs-down fa-2x"></i><span id="dislikeNumber" class="mx-2">{{$countDislike}}</span>
                            @endif

                        @else 
                            <i id="like_down" class="far fa-thumbs-down fa-2x"></i><span id="dislikeNumber" class="mx-2">{{$countDislike}}</span>
                        @endif
                    </a>

                    @foreach ($video->views as $view )
                        <span class="float-right">
                            عدد المشاهدات
                            <span class="viewsNumber">{{$view->views_number}}</span>
                        </span>
                    @endforeach

                    <div class="loginAlert mt-5"></div>
                </div>

                <div class="mt-4 px-2">
                    <div class="comments">
                        <div class="mb-3">
                            <span>التعليقات</span>
                        </div>

                        <div>
                            <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="إضافة تعليق عام"></textarea>
                            <button type="sumbit" class="btn btn-info mt-3 saveComment">تعليق</button>

                            <div class="commentAlert mt-5">

                            </div>

                            <div class="commentBody">
                                @foreach ($comments as $comment )
                                <div class="card mt-5 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{ $comment->user->profile_photo_url }}" width="150px" class="rounded-full" />
                                               
                                            </div>

                                             <div class="col-10">
                                                    @if(Auth::check())
                                                        @if($comment->user_id == auth()->user()->id || auth()->user()->isSuperAdmin())
                                                            <form method="POST" action="{{ route('comment.destroy', $comment->id) }}"
                                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف التعليق؟')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="float-left">
                                                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                                                            </button>
                                                            
                                                            </form>

                                                        <a href="{{ route('comment.edit', $comment->id) }}"
                                                            class="float-left">
                                                            <i class="far fa-edit text-success fa-lg ml-3"></i>
                                                        </a>

                                                        @endif

                                                    @endif

                                                    <p class="mt-3 mb-2">
                                                        <strong>{{$comment->user->name}}</strong>
                                                    </p>
                                                    <i class="far fa-clock"></i>
                                                    <span class="comment_date text-secondary">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                    <p class="mt-3">{{$comment->body}}</p>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#qualityPick').on('change', function () {
            const video = $('#videoPlayer')[0];
            const curTime = video.currentTime;
            const selected = $(this).val();

            let webmSrc = '';
            let mp4Src = ''

            if (selected == '1080') {
                webmSrc="{{ Storage::url($video_converted->webm_Format_1080) }}";
                mp4Src = "{{ Storage::url($video_converted->mp4_Format_1080) }}";
            }else if (selected == '720') {
                webmSrc="{{ Storage::url($video_converted->webm_Format_720) }}";
                mp4Src = "{{ Storage::url($video_converted->mp4_Format_720) }}";
            }
            else if (selected == '480') {
                webmSrc="{{ Storage::url($video_converted->webm_Format_480) }}";
                mp4Src = "{{ Storage::url($video_converted->mp4_Format_480) }}";
            }
            else if (selected == '360') {
                webmSrc="{{ Storage::url($video_converted->webm_Format_360) }}";
                mp4Src = "{{ Storage::url($video_converted->mp4_Format_360) }}";
            }
             else if (selected == '240') {
                webmSrc="{{ Storage::url($video_converted->webm_Format_240) }}";
                mp4Src = "{{ Storage::url($video_converted->mp4_Format_240) }}";
            }

            $('#webm_source').attr('src', webmSrc);
            $('#mp4_source').attr('src', mp4Src);


            video.load();
            video.play();
            video.currentTime = curTime;

        })

    </script>

    <script>
        $('.like').on('click', function (event) {
            const token = '{{ Session::token() }}';
            const urlLike = '{{ route('like') }}';

            let videoId = 0;

            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            const isBlocked = {{ Auth::check() && Auth::user()->isBlocked() ? 'true' : 'false' }};


            if (!isLoggedIn) {
                event.preventDefault();
                const html = `
                    <div class="alert alert-danger">
                        <ul>
                            <li class="loginAlert">
                                يجب عليك تسجيل الدخول لكي تستطيع الإعجاب بالفيديو    
                            </li>    
                        </ul>
                    </div>
                `;

              $('.loginAlert').html(html);
              return;
            }

            if (isBlocked) {
                event.preventDefault();
                const html = `
                    <div class="alert alert-danger">
                        <ul>
                            <li class="loginAlert">
                               أنت ممنوع من الإعجاب   
                            </li>    
                        </ul>
                    </div>
                `;
                 $('.loginAlert').html(html);
              return;
            }


            event.preventDefault();
            videoId = $('#videoId').val();
            const isLike = event.target.parentNode.previousElementSibling == null;

            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {
                    isLike,
                    videoId,
                    _token: token
                },
                success: function(data) {
                    if ($(event.target).hasClass('fa-thumbs-up')) {
                        if ($(event.target).hasClass('liked')) {
                            $(event.target).removeClass('liked');
                        }else {
                             $(event.target).addClass('liked');
                        }

                        $('#likeNumber').html(data.countLike);
                        $('#dislikeNumber').html(data.countDislike);
                    }

                    if ($(event.target).hasClass('fa-thumbs-down')) {
                        if ($(event.target).hasClass('liked')) {
                            $(event.target).removeClass('liked');
                        }else {
                             $(event.target).addClass('liked');
                        }

                        $('#likeNumber').html(data.countLike);
                        $('#dislikeNumber').html(data.countDislike);
                    }

                    if (isLike) {
                        $('.fa-thumbs-down').removeClass('liked');
                    }else {
                        $('.fa-thumbs-up').removeClass('liked');
                    }
                }
            })


        });
       
        
    </script>

    <script>
        $('#videoPlayer').on('ended', function(event) {
            const token = '{{ Session::token() }}';
            const urlView = '{{ route('view') }}';
            
            event.preventDefault();
            const videoId = $('#videoId').val();

            $.ajax({
                method: 'POST',
                url: urlView,
                data: {
                    videoId,
                    _token: token
                },
                success: function (data) {
                    $('.viewsNumber').html(data.viewsNumbers)
                }
            })
        });


    </script>

    <script>
        $('.saveComment').on('click', function(event) {
            const token = '{{ Session::token() }}';
            const urlComment = '{{ route('comment') }}';

            let videoId = 0;

            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            const isBlocked = {{ Auth::check() && Auth::user()->isBlocked() ? 'true' : 'false' }};

            

            if (!isLoggedIn) {
                event.preventDefault();
                const html = `<div class="alert alert-danger">
                    <ul>
                        <li>
                            يجب تسجيل الدخول كي تستطيع التعليق على الفيديو    
                        </li>
                    </ul>    
                </div>`;

                $('.commentAlert').html(html);
                return;
            }

            if (isBlocked) {
                 event.preventDefault();
                const html = `<div class="alert alert-danger">
                    <ul>
                        <li>
                           أنت ممنوع من التعليق 
                        </li>
                    </ul>    
                </div>`;

                $('.commentAlert').html(html);
                return;
            }


            if ($('#comment').val().length == 0) {
                 const html = `<div class="alert alert-danger">
                    <ul>
                        <li>
                            الرجاء كتابة تعليق   
                        </li>
                    </ul>    
                </div>`;

                $('.commentAlert').html(html);
                return;
            }

            $('.commentAlert').html('');
            event.preventDefault();
            videoId = $('#videoId').val();
            comment = $('#comment').val();

 

            $.ajax({
                method: 'POST',
                url: urlComment,
                data: {
                    comment,
                    videoId,
                    _token: token
                },
                success: function(data) {
                    $('#comment').val('');

                        const destroyUrl = "{{ route('comment.destroy', 'des_id') }}";
                        const destroy = destroyUrl.replace('des_id', data.commentId);

                        const editUrl = "{{ route('comment.edit', 'id') }}";
                        const edit = editUrl.replace('id', data.commentId);

                    const html = `
                         <div class="card mt-5 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="${data.userImage}" width="150px" class="rounded-full" />
                                               
                                            </div>

                                             <div class="col-10">

                                                <form method="POST" action="${destroy}"
                                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف التعليق؟')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="float-left">
                                                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                                                            </button>
                                                            
                                                            </form>

                                                        <a href="${edit}"
                                                            class="float-left">
                                                            <i class="far fa-edit text-success fa-lg ml-3"></i>
                                                        </a>


                                                    <p class="mt-3 mb-2">
                                                        <strong>${data.username}</strong>
                                                    </p>
                                                    <i class="far fa-clock"></i>
                                                    <span class="comment_date text-secondary">
                                                       ${data.commentDate}
                                                    </span>
                                                    <p class="mt-3">${comment}</p>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                    `

                    $('.commentBody').prepend(html)
                }
            })
        })

    </script>
@endsection