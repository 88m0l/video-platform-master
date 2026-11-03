<!DOCTYPE html>
<html lang="ar">

     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            فيديو حسوب
        </title>
        
        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
     </head>
        

    <body dir="rtl">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">فيديو حسوب</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('main') ? 'active': '' }}" href="{{ route('main') }}">
                            <i class="fa-solid fa-house"></i>
                            الصفحة الرئيسية
                        </a>
                    </li>

                    @auth
                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('history') ? 'active': '' }}" href="{{ route('history') }}">
                            <i class="fa-solid fa-history"></i>
                            سجل المشاهدة
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('videos.create') ? 'active': '' }}" href="{{ route('videos.create') }}">
                            <i class="fa-solid fa-upload"></i>
                           رفع فيديو
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('videos.index') ? 'active': '' }}" href="{{ route('videos.index') }}">
                            <i class="fa-solid fa-play-circle"></i>
                           فيديوهاتي
                        </a>
                    </li>
                     @endauth
                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('channel.index') ? 'active': '' }}" href="{{ route('channel.index') }}">
                            <i class="fa-solid fa-film"></i>
                           القنوات
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav mr-auto items-center">

                    @auth
                        <li class="nav-item dropdown mt-2">
                            <a class="nav-link position-relative" href="#"
                              id="notifications-dropdown"
                              role="button"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                            <i class="fas fa-bell fa-fw fa-lg"></i>
                            <span id="notifications-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                                {{ App\Models\Alert::where('user_id', auth()->user()->id)->first()->alert }}

                            </span>
                            </a>

                            <ul id="notifications-list" class="dropdown-menu w-[400px] text-right">

                            </ul>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="{{ route('login') }}">
                               تسجيل الدخول
                            </a>
                        </li>

                         <li class="nav-item mt-2">
                            <a class="nav-link" href="{{ route('register') }}">
                               إنشاء حساب
                            </a>
                        </li>


                    @else    

                     <li class="nav-item dropdown justify-content-left mt-2">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </a>

                        <div class="dropdown-menu px-2 text-right mt-2">
                            <div class="pt-4 pb-1 border-t border-gray-200 w-[200px]">
                                <div class="flex items-center">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <div class="shrink-0 me-3">
                                            <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </div>
                                    @endif

                                    <div>
                                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="mt-3 space-y-1 text-right">

                                    @can('update-videos')
                                        <x-responsive-nav-link href="{{ route('admin.index') }}">
                                            لوحة الإدارة
                                        </x-responsive-nav-link>
                                    @endcan

                                    <!-- Account Management -->
                                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                        {{ __('site.profile') }}
                                    </x-responsive-nav-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-responsive-nav-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                            {{ __('site.logout') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </li>
                    @endguest
                </ul>
            </div>
        </div>
        </nav>

        <main class="py-4">
            @if(Session::has('success')) 
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>

               
            @endif

             @yield('content')

        </main>

        @livewireScripts

        <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('ddeba01523cff76d8bb9', {
                cluster: 'eu'
            });

        </script>

        @vite(['resources/js/pushNotifications.js', 'resources/js/faildNotifications.js'])

        <script>
            $('#notifications-dropdown').on('click', function () {
                const token = '{{ Session::token() }}';
                const urlNotify = '{{ route('notification') }}';
                const notificationsCount = $('#notifications-count');

                $.ajax({
                    method: 'POST',
                    url: urlNotify,
                    data: {
                        _token: token
                    },
                    success: function(data) {
                        notificationsCount.text(0);
                        let notificationsList = '';

                        $.each(data.latestNotifications, function(i, item) {
                            const notificationDate = new Date(item.created_at);
                            const date = `${notificationDate.getFullYear()} - ${notificationDate.getMonth() + 1} - ${notificationDate.getDate()}`;
                            const time = `${notificationDate.getHours()}:${notificationDate.getMinutes()}:${notificationDate.getSeconds()}`; 

                            if(item.success) {
                                notificationsList+=`
                                    <li class="px-3 text-right">
                                        <a class="text-sm" href="/videos/${item.video_id}">
                                            تهانينا تم معالجة مقطع الفيديو ${item.notification} بنجاح    
                                            
                                            <span class="block text-gray-700 mt-1">
                                                    ${date} الساعة  ${time}
                                            </span>
                                            
                                        </a>
                                    </li>
                                    <hr />
                                `
                            }else {
                                notificationsList+=`
                                    <li class="px-3 text-right">
                                        <a class="text-sm" href="#">
                                            للأسف حدث خطأ في معالجة الفيديو ${item.notification} 
                                            
                                            <span class="block text-gray-700 mt-1">
                                                    ${date} الساعة  ${time}
                                            </span>
                                            
                                        </a>
                                    </li>
                                    <hr />
                                `
                            }

                        });


                        notificationsList+=`
                        
                            <li class="py-2 text-center underline">
                                <a href="{{ route('all.notification') }}">
                                    عرض جميع التنبيهات    
                                </a>
                            </li>

                        `

                        $('#notifications-list').html(notificationsList);
                    }
                })
            });
        </script>

        @yield('scripts')
    </body>

</html>