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
                           تاريخ الإنشاء
                        </th>
                         <th>
                          فك الحظر
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($channels as $channel )
                        <tr>
                        <td>{{$channel->name}}</td>
                        <td>{{$channel->email}}</td>
                        <td>{{$channel->created_at->diffForHumans()}}</td>
                        <td>
                            <form style="display: inline-block" method="POST" action="{{ route('channels.unblock', $channel) }}">
                                @method('PATCH')
                                @csrf
                                
                                @if($channel->isBlocked())
                                    <button type="submit" class="btn btn-warning btn-sm"
                                     onclick="return confirm('هل أنت متأكد أنك تريد فك الحظر عن القناة؟')"
                                    >
                                    <i class="fa fa-lock-open"></i> فك الحظر

                                    </button>
                                @endif
                            </form>
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