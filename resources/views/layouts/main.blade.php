<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.blade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/member.blade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/store.blade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transport.blade.css') }}">
</head>

<body>
<!-- member index section -->
<section class="member-index-section container-fluid">
    <div class="member-index-main row col-12">
        <!-- sidebar -->
    @include('layouts.sidebar')
    <!-- member index body -->
        <div class="member-index-body col-lg-10">
            <!-- mark -->
            <div class="member-index-big-mark">
                <h1>千森株式會社會員管理平台</h1>
                <div class="member-index-sort">
                    @yield('topBar')
                </div>
            </div>
            <hr>
            @yield('content')
        </div>
    </div>
</section>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script>
    $("#store_input,#transport_input,#ship_input").on('change', function () {
        //console.log(this.files[0]["type"]);
        //alert(this.files[0]["type"]);
        let fileExtension = ['xlsx'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("目前只支援 : "+fileExtension.join(', '));
        }
        $(this).parent().submit();
    });
</script>
</body>
