<head>
    @if($is_admin)
    <title>管理員登入</title>
    @else
    <title>會員登入</title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- section -->
    <section class="login-section">
        <div class="login-body">
            <div class="logo-image">
                <img src="{{ asset('css/image/login-logo.png')}}" alt="">
            </div>
            <!-- login block -->
            @if($is_admin)
            <div id="loginBlock" class="login-block">
                <h2 class="login-title">管理員登入</h2>
                <form class="login-check" action="{{ url('login') }}" method="post">
                    <div class="login-input">
                        <img src="{{ asset('css/image/login-input-01.png')}}" alt="">
                        <input type="text" name="account" placeholder="帳號/手機">
                    </div>
                    <div class="login-input">
                        <img src="{{ asset('css/image/login-input-02.png')}}" alt="">
                        <input type="text" name="password" placeholder="密碼">
                    </div>
                    <div class="login-admin">
                        <input type="submit" value="登入" ></input>
                    </div>
                </form>
            </div>
            @else
            <!-- member login -->
            <div class="member-login">
                <!-- member login block -->
                @if (!\Session::has('create'))
                <div id="memberloginBlock" class="login-block">
                    <h2 class="login-title">會員登入</h2>
                    <form class="login-check" action="{{ url('login') }}" method="post">
                        <div class="login-check">
                            <div class="login-input">
                                <img src="{{ asset('css/image/login-input-01.png')}}" alt="">
                                <input type="text" name="account" placeholder="帳號/手機">
                            </div>
                            <div class="login-input">
                                <img src="{{ asset('css/image/login-input-02.png')}}" alt="">
                                <input type="text" name="password" placeholder="密碼">
                            </div>
                        </div>
                        <div class="login-admin">
                            <input type="submit" value="登入" style="border:none;"></input>
                        </div>
                    </form>
                    <div class="password-edit">
                        <button class="btn" onclick="forget()" >忘記密碼</button>
                        <button class="btn" onclick="register()">註冊會員</button>
                    </div>
                </div>
                @endif
                <!-- member register block -->
                <form action="{{ url('users') }}" method="post">
                <div id="registerBlock" class="login-block register-block">
                    <h2 class="login-title">會員註冊</h2>
                    <!-- member edit body -->
                    <div class="modal-body register-body">
                        <span class="register-data">
                            <p>真實姓名*</p><input type="text" name="name" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>出生年月日*</p><input type="date" name="birthday" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>聯絡地址*</p><input type="text" name="address" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>聯絡電話*</p><input type="tel" name="account" placeholder="請輸入「EZ WAY易利委」所使用之手機號碼" required>
                        </span>
                        <span class="register-data">
                            <p>密碼*</p><input type="password" name="password" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>收件地址</p><input type="text" name="get_address" placeholder="（若與聯絡地址相同，無需填寫）">
                        </span>
                        <span class="register-data">
                            <p>收件人電話</p><input type="tel" name="get_phone" placeholder="（若與聯絡地址相同，無需填寫）">
                        </span>
                        <span class="register-data">
                            <p>LINE ID*</p><input type="text" name="line_id" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>電子信箱*</p><input type="email" name="email" placeholder="" required>
                        </span>
                        <span class="register-data">
                            <p>性別*</p>
                            <input type="radio" name="gender" value="2" required>女
                            <input type="radio" name="gender" value="1">男
                        </span>
                    </div>
                    <div class="login-admin">
                        <button type="submit" class="btn">註冊</button>
                    </div>
                </div>
                </form>
                <!-- member check block -->
                @if (\Session::has('create'))
                <div id="checkBlock" class="login-block check-block">
                    <h2 class="login-title">已發送驗證信件，至您的信箱</h2>
                    <p>系統已自動發送驗證信件至您的聯絡信箱，請至信箱點擊連結來完成資料驗證。</p>
                </div>
                @endif
                <!-- member forget -->
                <form action="{{ url('forgot') }}" method="post">
                <div id="forgetBlock" class="login-block forget-block">
                    <h2 class="login-title">忘記密碼</h2>
                    <input type="email" name="email" class="form-control" placeholder="請輸入信箱">
                    <div class="login-admin">
                        <button type="submit" class="btn">送出</button>
                    </div>
                </div>
                </form>
            </div>
            @endif
        </div>
    </section>
    <!-- member terms block -->
    <div class="terms-block member-btn">
        <button class="btn"> <a href="{{ url('privacy') }}">隱私權政策</a></button>
        <button class="btn"> <a href="{{ url('service') }}">服務條款</a></button>
    </div>
<script>

    function register(){
        const memberloginBlock = document.getElementById("memberloginBlock");
        const registerBlock = document.getElementById("registerBlock");
        const forgetBlock = document.getElementById("forgetBlock");
        // const checkBlock = document.getElementById("checkBlock");

        memberloginBlock.style.display="none";
        // checkBlock.style.display="none";
        registerBlock.style.display="block";
        forgetBlock.style.display="none";
    }
    function checkBlock(){
        const memberloginBlock = document.getElementById("memberloginBlock");
        const registerBlock = document.getElementById("registerBlock");
        const forgetBlock = document.getElementById("forgetBlock");
        const checkBlock = document.getElementById("checkBlock");

        checkBlock.style.display="block";
        memberloginBlock.style.display="none";
        forgetBlock.style.display="none";
        registerBlock.style.display="none";
    }
    function forget(){
        const memberloginBlock = document.getElementById("memberloginBlock");
        const registerBlock = document.getElementById("registerBlock");
        const forgetBlock = document.getElementById("forgetBlock");
        // const checkBlock = document.getElementById("checkBlock");

        memberloginBlock.style.display="none";
        // checkBlock.style.display="none";
        registerBlock.style.display="none";
        forgetBlock.style.display="block";

    }

</script>


</body>
