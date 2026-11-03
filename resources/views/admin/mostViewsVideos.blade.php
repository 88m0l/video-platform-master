@extends('theme.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <table id="videos-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            اسم الفيديو
                        </th>
                         <th>
                           اسم القناة
                        </th>
                        <th>
                           عدد المشاهدات
                        </th>
                         <th>
                         تاريخ النشر
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mostViewsVideos as $view )
                        <tr>
                        <td>
                            <a href="/videos/{{ $view->video->id }}">
                                 {{$view->video->title}}
                            </a>
                           
                        </td>
                        <td>{{$view->user->name}}</td>
                        <td>{{$view->views_number}}</td>
                        <td>
                            {{$view->video->created_at}}
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <canvas id="myChart"></canvas>
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

    <script>
  const names = <?php echo $videoNames; ?>;
  const totalViews = <?php echo $videoViews; ?>;
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: names,
      datasets: [{
        label: 'الفيديوهات الأكثر مشاهدة',
        data: totalViews,
        backgroundColor: 'rgb(0,33,47)',
        borderColor: 'rgb(255, 99, 132)'
      }]
    },
  });

    </script>
@endsection


