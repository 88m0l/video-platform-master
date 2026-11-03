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
                           نوع القناة
                        </th>
                         <th>
                          تعديل
                        </th>
                        <th>
                          حذف
                        </th>
                         <th>
                          حظر
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                        <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->isSuperAdmin() ? 'مدير عام' : ($user->isAdmin() ? 'مدير' : 'مستخدم')}}</td>
                        <td>
                            <form class="d-flex justify-content-between" method="POST" action={{ route('channels.update', $user) }}>
                                @method('PATCH')
                                @csrf
                                <select class="form-control form-control-sm ms-1" name="user_type">
                                    <option selected disabled>اختر نوعاً</option>
                                    <option value="user">مستخدم</option>
                                    <option value="admin">مدير</option>
                                    <option value="super_admin">مدير عام</option>
                                </select>

                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                             <form style="display: inline-block" method="POST" action="{{ route('channels.delete', $user) }}">
                                @method('DELETE')
                                @csrf
                                
                                @if(auth()->user()->id != $user->id && !$user->isSuperAdmin())
                                    
                                 <button type="submit" class="btn btn-danger btn-sm"
                                 onclick="return confirm('هل أنت متأكد أنك تريد حذف المستخدم؟')"
                                 >
                                    <i class="fa fa-trash"></i>
                                    حذف
                                </button>

                                @else
                                    <div class="btn btn-danger btn-sm disabled">
                                        <i class="fa fa-trash"></i> حذف
                                    </div>
                                @endif

                               
                            </form>
                            </td>
                           <td>
                            <form style="display: inline-block" method="POST" action="{{ route('channels.block', $user) }}">
                                @method('PATCH')
                                @csrf
                                
                                @if(auth()->user()->id != $user->id && !$user->isSuperAdmin())
                                    @if ($user->isBlocked())
                                        <div class="btn btn-warning btn-sm disabled">
                                            <i class="fas fa-lock"></i> محظور
                                        </div>
                                    @else
                                        <button type="submit" class="btn btn-warning btn-sm"
                                         onclick="return confirm('هل أنت متأكد أنك تريد حظر القناة؟')"
                                        >
                                            <i class="fa fa-lock"></i> حظر
                                        </button>

                                    @endif
                                

                                @else
                                    <div class="btn btn-warning btn-sm disabled">
                                            <i class="fas fa-lock"></i> حظر
                                    </div>
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