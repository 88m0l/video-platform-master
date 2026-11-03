@extends('theme.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <table id="videos-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            اسم القناة
                        </th>
                         <th>
                           البريد الإلكتروني
                        </th>
                        <th>
                           عدد مقاطع الفيديو
                        </th>
                         <th>
                          مجموع المشاهدات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($channels as $channel )
                        <tr>
                        <td>
                            <a href="{{ route('main.channels.videos', $channel) }}">
                                 {{$channel->name}}
                            </a>
                           
                        </td>
                        <td>{{$channel->email}}</td>
                        <td>{{$channel->videos->count()}}</td>
                        <td>
                            {{$channel->views->sum('views_number')}}
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


@section('scripts')
    <script>

        const dataTable = document.getElementById('videos-table');
        if (dataTable) {
            new simpleDatatables.DataTable(dataTable, {
                labels: {
                    placeholder: 'ابحث في الجدول',
                    perPage: 'عدد الحقول في الجدول',
                    info: 'إظهار {start} إلى {end} من {rows} حقول'
                }
            })
        }

    </script>
@endsection