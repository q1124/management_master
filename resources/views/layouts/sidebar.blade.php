
<div class="sidebar col-lg-2">
    <div class="sidebar-logo">
        <a href="{{ url('member')}}"><img src="{{ asset('css/image/login-logo.png') }}" alt=""></a>
    </div>
    @if(Auth::user()->role == 99)
    <!--/ vendor sidebar-card /-->
    <div id="accordion" class="sidebar-accordion vendor-sidebar">
        <!--sidebar-card-->
        <div class="sidebar-card">
            <div class="sidebar-header sidebar-line" id="headingOne">
                <h5 class="mb-0 sidebar-title">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        <img src="{{ asset('css/image/sidebar-img-01.png') }}" alt="">
                        <a href="{{ url('admin') }}">會員管理</a>
                    </button>
                </h5>
            </div>
        </div>
        <!--sidebar-card-->
        <div class="sidebar-card">
            <div class="sidebar-header" id="headingTwo">
                <h5 class="mb-0 sidebar-title">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <img style="margin-left:5px" src="{{ asset('css/image/sidebar-img-02.png') }}" alt="">
                        資料匯入
                        <div class="sidebar-down">
                            <img src="{{ asset('css/image/sidebar-img-03.png') }}" alt="">
                        </div>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordion">
                <div class="card-body">
                    <ul class="sidebar-list">
                        <li onclick='$("#store_input").click()'>匯入入倉履歷</li>
                        <li onclick='$("#transport_input").click()'>匯入運輸紀錄</li>
                        <li onclick='$("#ship_input").click()'>匯入出貨明細</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @else
    <!--/ member sidebar-card /-->
    <div id="accordion" class="sidebar-accordion member-sidebar">
        <!--sidebar-card-->
        <div class="sidebar-card">
            <div class="sidebar-header" id="headingTwo">
                <h5 class="mb-0 sidebar-title">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <img style="margin-left:5px" src="{{ asset('css/image/sidebar-img-02.png') }}" alt="">
                        首頁
                        <div class="sidebar-down">
                            <img src="{{ asset('css/image/sidebar-img-03.png') }}" alt="">
                        </div>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordion">
                <div class="card-body">
                    <ul class="sidebar-list">
                        <a href="{{ url('member')}}"><li>個人基本資料</li></a>
                        <a href="{{ url('/member/#GoldRecord') }}"><li>預付金紀錄</li></a>
                        <a href="{{ url('/member/#StoreRecord') }}"><li>入倉履歷</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- form data -->
    <form action="{{ url('/stores/import') }}" method="post" enctype="multipart/form-data" hidden>
        入倉履歷匯入
        <input id="store_input" type="file" name="file">
        <input type="submit">
    </form>

    <form action="{{ url('/transports/import') }}" method="post" enctype="multipart/form-data" hidden>
        運輸紀錄匯入
        <input id="transport_input" type="file" name="file">
        <input type="submit">
    </form>

    <form action="{{ url('/ships/import') }}" method="post" enctype="multipart/form-data" hidden>
        出貨明細匯入
        <input id="ship_input" type="file" name="file">
        <input type="submit">
    </form>

    <div class="signout">
         <a href="{{ url('logout') }}">登出</a>
    </div>
</div>
