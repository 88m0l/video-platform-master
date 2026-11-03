@extends('layouts.main')

@section('content')
    <div class="container">
        <p class="my-4 font-weight-bold">{{$title}}</p>
        <div class="row">
            @forelse ($notifications as $notification )
                <div class="card mb-2" style="width: 56rem">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <div class="rounded-full bg-secondary flex justify-content-center align-items-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="far fa-bell text-white"></i>
                                </div>
                            </div>
                            <div class="col-10">
                                <i class="far fa-clock"></i>
                                <span class="text-secondary">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>

                                @if($notification->success)
                                    <p class="mt-3" style="width: 40rem;">
                                        تهانينا تمت معالجة مقطع الفيديو {{ $notification->notification }}
                                    </p>
                                @else
                                    <p class="mt-3" style="width: 40rem;">
                                         للأسف لم تتم معالجة مقطع الفيديو بنجاح {{ $notification->notification }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="mx-auto col-8">
                    <div class="alert alert-primary text-center" role="alert">
                        لا يوجد إشعارات
                    </div>
                </div>
            @endforelse

        </div>
    </div>

@endsection