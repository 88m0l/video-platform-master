 <div id="layoutSidenav_nav" class="mt-4">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                الإحصائيات
                            </a>

                             <a class="nav-link" href="{{ route('channels.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-lock"></i></div>
                                الصلاحيات
                            </a>

                             <a class="nav-link" href="{{ route('channels.blocked') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                                القنوات المحظورة
                            </a>

                             <a class="nav-link" href="{{ route('channels.all') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-film"></i></div>
                                القنوات
                            </a>

                             <a class="nav-link" href="{{ route('most.views.videos') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                الأكثر مشاهدة
                            </a>
                           
                        </div>
                    </div>
                </nav>
            </div>