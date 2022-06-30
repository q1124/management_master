@extends('layouts.main')

@section('title','會員管理平台')

@section('topBar')
    @if(Auth::user() ->role == 99)
    <a href="{{ url('admin')}}"><span class="previouspage">會員管理 / </span></a><a href="{{ url('member')}}"><span class="sort-name">{{ Auth::user()->name }}</span></a>
    @else
    <a href="{{ url('member')}}"><span class="previouspage">首頁</span></a>
    @endif
@endsection

@section('content')
    <div class="right-memeber row col-lg-12">
        <!-- member block  -->
        <div class="member-block member-infro-block col-lg-4">
            <div class="member-title">
                <h2>會員基本資料</h2>
                @if(Auth::user()->role == 99)
                    <button class="btn edit-infro vendor-btn" data-toggle="modal"
                            data-target="#vendorEditModal">編輯
                    </button>
                @else
                    <button class="btn edit-infro member-btn" data-toggle="modal"
                            data-target="#memberEditModal">變更密碼
                    </button>
                @endif
            </div>
            <!-- ---table menber--- -->
            <table class="personal-information">
                <tbody class="infro-body">
                <tr class="infro-title">
                    <td>會員編號</td>
                    <td>{{ $current_user->u_id }}</td>
                </tr>
                <tr class="infro-title">
                    <td>真實姓名</td>
                    <td>{{ $current_user->name }}</td>
                </tr>
                <tr class="infro-title">
                    <td>出生年月日</td>
                    <td>{{ $current_user->birthday }}</td>
                </tr>
                <tr class="infro-title">
                    <td>聯絡地址</td>
                    <td>{{ $current_user->address }}</td>
                </tr>
                <tr class="infro-title">
                    <td>聯絡電話</td>
                    <td>{{ $current_user->account }}</td>
                </tr>
                <tr class="infro-title">
                    <td>密碼</td>
                    <td>{{ $current_user->password }}</td>
                </tr>
                <tr class="infro-title">
                    <td>收件地址</td>
                    <td>{{ $current_user->get_address }}</td>
                </tr>
                <tr class="infro-title">
                    <td>收件人電話</td>
                    <td>{{ $current_user->get_phone }}</td>
                </tr>
                <tr class="infro-title">
                    <td>LINE ID</td>
                    <td>{{ $current_user->line_id }}</td>
                </tr>
                <tr class="infro-title">
                    <td>電子信箱</td>
                    <td>{{ $current_user->email }}</td>
                </tr>
                <tr class="infro-title">
                    <td>性別</td>
                    <td>{{ config('map.gender')[$current_user->gender] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- Gold block -->
        <div class="gold-block col">
            <!-- Gold block-1 -->
            <div id="#GoldRecord" class="gold-flow col">
                <!-- gold stored -->
                <div class="member-block">
                    <div class="member-title">
                        <h2>預付金儲值紀錄</h2>
                        @if(Auth::user()->role == 99)
                            <button class="btn member-infro gold-add vendor-btn" onclick="create_modalFirst()">新增
                            </button>
                        @endif
                    </div>
                    <!-- table stored -->
                    <div class="stored-table first-stored-block">
                        <table class="personal-information stored-information">
                            <tbody class="stored-body">
                            <!-- title -->
                            <tr class="stored-table-title infro-title gold-line stored-title">
                                <td>儲值日期</td>
                                <td>儲值金額(台幣)</td>
                                <td>使用匯率</td>
                                <td>日幣金額</td>
                                <td>備註</td>
                            </tr>
                            <!-- gold stored -->
                            <tbody>
                            @php
                                $store_price = 0;
                            @endphp
                            @foreach($current_user->deposits as $deposit)
                                <tr class="infro-title stored-title gold-line">
                                    <td>{{ $deposit->c_date }}</td>
                                    <td>{{ $deposit->amount }}</td>
                                    <td>{{ $deposit->rate }}</td>
                                    <td>{{ $deposit->jpy }}</td>
                                    <td>{{ $deposit->note }}</td>
                                    @if(Auth::user()->role==99)
                                        <td class="vendor-btn">
                                            <form class="explanation-btn" action="{{ url('deposits/'.$deposit->id) }}"
                                                  method="post">
                                                <input type="button" value="編輯"
                                                       data-url="{{ url('deposits/'.$deposit->id) }}"
                                                       data-c_date="{{ $deposit->c_date }}"
                                                       data-amount="{{ $deposit->amount }}"
                                                       data-rate="{{ $deposit->rate }}"
                                                       data-jpy="{{ $deposit->jpy }}"
                                                       data-note="{{ $deposit->note }}"
                                                       onclick="edit_modalFirst(this)">
                                                @method('DELETE')
                                                <input type="submit" value="刪除">
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @php
                                    /* @var $store_price */
                                    /* @var $deposit */
                                    $store_price = $store_price + $deposit->jpy;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Gold block-2 -->
            <div class="gold-flow col">
                <!-- gold stored -->
                <div class="member-block">
                    <div class="member-title">
                        <h2>預付金使用紀錄</h2>
                    </div>
                    <!-- table stored -->
                    <div class="stored-table sec-stored-block">
                        <table class="personal-information stored-information">
                            <tbody class="stored-body">
                            <!-- title -->
                            <tr class="stored-table-title infro-title gold-line stored-title">
                                <td style="color: #FFC107;">您目前的購物金餘額</td>
                            </tr>
                            <tr class="infro-title stored-title gold-line">
                                <td>{{ $store_price - $total_use }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="personal-information stored-information">
                            <tbody class="stored-body">
                            <!-- title -->
                            <tr class="stored-table-title infro-title gold-line stored-title">
                                <td>使用日期</td>
                                <td>國際貨運追蹤號碼</td>
                                <td>購物金額(日幣)</td>
                            </tr>
                            <!-- body -->
                            <!-- gold stored -->
                            @foreach($use_datas as $use_data)
                                <tr class="infro-title stored-title gold-line">
                                    <td>{{ $use_data['use_date'] }}</td>
                                    <td>{{ $use_data['order_no'] }}</td>
                                    <td>{{ $use_data['total'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!-- Gold block-3 -->
            <div id="#StoreRecord" class="gold-flow col">
                <!-- gold stored -->
                <div class="member-block">
                    <div class="member-title">
                        <h2>入倉履歷</h2>
                        @if(Auth::user()->role == 99)
                            <button class="btn member-infro gold-add vendor-btn" onclick="create_modalSec()">新增</button>
                        @endif
                    </div>
                    <!-- table stored -->
                    <div class="stored-table thr-stored-block">
                        <table class="personal-information stored-information">
                            <tbody class="stored-body">
                            <!-- title -->
                            <tr class="stored-table-title infro-title gold-line stored-title">
                                <td>入倉日期</td>
                                <td>國內運輸公司/取貨地點</td>
                                <td>日本國內運輸公司<br>追蹤單號</td>
                            </tr>
                            <!-- body -->
                            <!-- gold stored -->
                            @foreach($current_user->stores as $store)
                                <tr class="infro-title stored-title gold-line">
                                    <td>{{ $store->c_date }}</td>
                                    <td>{{ $store->location }}</td>
                                    <td><a href="{{ url('stores/'.$store->id) }}">{{ $store->store_no }}</a></td>
                                    @if(Auth::user() -> role == 99)
                                        <td class="vendor-btn">
                                            <form class="explanation-btn" action="{{ url('stores/'.$store->id) }}"
                                                  method="post">
                                                <input type="button" value="編輯"
                                                       data-url="{{ url('stores/'.$store->id) }}"
                                                       data-c_date="{{ $store->c_date }}"
                                                       data-location="{{ $store->location }}"
                                                       data-store_no="{{ $store->store_no }}"
                                                       onclick="edit_modalSec(this)">
                                                @method('DELETE')
                                                <input type="submit" value="刪除">
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ---edit modal--- -->
    <!--/ vendor edit modal / -->
    <div class="modal edit-modal vendor-modal" id="vendorEditModal" tabindex="-1" role="dialog"
         aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog edit-dialog " role="document">
            <div class="modal-content edit-content">
                <div class="modal-header edit-header">
                    <h5 class="edit-title vendor-mark">編輯會員基本基料</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- vendor edit body -->
                <form action="{{ url('users/'.$current_user->id) }}" method="post">
                    @method("PUT")
                    <div class="modal-body edit-body vendor-modal">
                                <span class="edit-data">
                                    <p>會員編號</p><span class="member-num">{{ $current_user->u_id }}</span>
                                </span>
                        <span class="edit-data">
                                    <p>真實姓名</p><input type="text" name="name" value="{{ $current_user->name }}">
                                </span>
                        <span class="edit-data">
                                    <p>出生年月日</p><input type="date" name="birthday"
                                                       value="{{ $current_user->birthday }}">
                                </span>
                        <span class="edit-data">
                                    <p>聯絡地址</p><input type="text" name="address" value="{{ $current_user->address }}">
                                </span>
                        <span class="edit-data">
                                    <p>聯絡電話</p><input type="tel" name="account" value="{{ $current_user->account }}">
                                </span>
                        <span class="edit-data">
                                    <p>密碼</p><input type="password" name="password"
                                                    value="{{ $current_user->password }}">
                                </span>
                        <span class="edit-data">
                                    <p>收件地址</p><input type="text" name="get_address"
                                                      value="{{ $current_user->get_address }}">
                                </span>
                        <span class="edit-data">
                                    <p>收件人電話</p><input type="tel" name="get_phone"
                                                       value="{{ $current_user->get_phone }}">
                                </span>
                        <span class="edit-data">
                                    <p>LINE ID</p><input type="text" name="line_id"
                                                         value="{{ $current_user->line_id }}">
                                </span>
                        <span class="edit-data">
                                    <p>電子信箱</p><input type="email" name="email" value="{{ $current_user->email }}">
                                </span>
                        <span class="edit-data" style="align-items: center;">
                                    <p>性別</p>
                                    <input type="radio" name="gender" value="2" {{ ($current_user->gender == 2)? 'checked' :'' }}>女
                                    <input type="radio" name="gender" value="1" {{ ($current_user->gender == 1)? 'checked' :'' }}>男
                        </span>
                    </div>
                    <!-- infro edit submit -->
                    <div class="modal-footer edit-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                        <button type="submit" class="btn btn-primary">儲存變更</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/ member edit modal / -->
    <div class="modal edit-modal member-modal" id="memberEditModal" tabindex="-1" role="dialog"
         aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog edit-dialog " role="document">
            <div class="modal-content edit-content">
                <div class="modal-header edit-header">
                    <h5 class="edit-title member-mark">變更密碼</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- member edit body -->
                <form action="{{ url('users/'.$current_user->id) }}" method="post">
                    @method("PUT")
                    <div class="modal-body edit-body member-modal">
                                <span class="edit-data member-newpassword">
                                    <input type="password" placeholder="新密碼" required>
                                </span>
                        <span class="edit-data member-newpassword">
                                    <input type="password" name="password" placeholder="二次輸入新密碼" required>
                                </span>
                    </div>
                    <!-- infro edit submit -->
                    <div class="modal-footer edit-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                        <button type="submit" class="btn btn-primary">儲存變更</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- gold edit modal-One -->
    <div class="modal edit-modal" id="goldAddModalOne" tabindex="-1" role="dialog"
         aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog edit-dialog " role="document">
            <div class="modal-content edit-content">
                <div class="modal-header edit-header">
                    <h5 class="edit-title" id="goldEditModalOneTitle">編輯預付金紀錄</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- gold edit body -->
                <form action="" method="POST">
                    @method("PUT")
                    <div class="modal-body edit-body">
                        <span class="edit-data gold-data">
                            <p>儲值日期</p><input type="date" name="c_date" value="" required>
                        </span>
                        <span class="edit-data">
                            <p>儲值金額 <br> (台幣)</p><input type="number" name="amount" value="" required>
                        </span>
                        <span class="edit-data gold-data">
                            <p>使用匯率</p><input type="number" name="rate" value="" min=0 step=0.001 onchange="$(this).val(parseFloat($(this).val()).toFixed(3))" required>
                        </span>
                        <span class="edit-data gold-data unit-input">
                            <p>日幣金額</p><input type="tel" name="jpy" value=""  placeholder="¥" required>
                        </span>
                        <span class="edit-data gold-data">
                            <p>備註</p><input type="text" name="note" value="" required>
                        </span>
                    </div>
                    <!-- gold edit submit -->
                    <div class="modal-footer edit-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">關閉
                        </button>
                        <button type="submit" class="btn btn-primary">儲存變更</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- gold edit modal-Sec -->
    <div class="modal edit-modal" id="goldEditModalSec" tabindex="-1" role="dialog"
         aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog edit-dialog " role="document">
            <div class="modal-content edit-content">
                <div class="modal-header edit-header">
                    <h5 class="edit-title" id="goldEditModalSecTitle">編輯預付金紀錄</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- gold edit body -->
                <form action="" method="POST">
                    @method("PUT")
                    <div class="modal-body edit-body">
                        <span class="edit-data gold-data">
                            <p>入倉日期</p><input type="date" name="c_date" value="" required>
                        </span>
                        <span class="edit-data">
                            <p>國內運輸公司/取貨地點</p><input type="text" name="location" value="" required>
                        </span>
                        <span class="edit-data gold-data">
                            <p>日本國內運輸公司<br>追蹤單號</p><input type="text" name="store_no" value="" required>
                        </span>
                    </div>
                    <!-- gold edit submit -->
                    <div class="modal-footer edit-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">關閉
                        </button>
                        <button type="submit" class="btn btn-primary">儲存變更</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // gold edit modal-First
        function create_modalFirst() {
            $("#goldAddModalOne form").attr('action', "{{ url('deposits') }}");
            $("#goldAddModalOne form").find("input").val("");
            $("#goldEditModalOneTitle").text("新增預付金儲值紀錄");
            $('#goldAddModalOne').modal('show');
        }

        function edit_modalFirst(obj) {
            let url = $(obj).data('url');
            let c_date = $(obj).data('c_date');
            let amount = $(obj).data('amount');
            let rate = $(obj).data('rate');
            let jpy = $(obj).data('jpy');
            let note = $(obj).data('note');

            //$("[name='order']").val(order);
            $("#goldAddModalOne form").attr('action', url);
            $("#goldAddModalOne form").find("[name='c_date']").val(c_date);
            $("#goldAddModalOne form").find("[name='amount']").val(amount);
            $("#goldAddModalOne form").find("[name='rate']").val(rate);
            $("#goldAddModalOne form").find("[name='jpy']").val(jpy);
            $("#goldAddModalOne form").find("[name='note']").val(note);
            $("#goldAddModalOne form").find("[name='_method']").val("PUT");
            $("#goldAddModalOneTitle").text("編輯預付金儲值紀錄");

            $('#goldAddModalOne').modal('show');
        }

        // gold edit modal-Sec
        function create_modalSec() {
            $("#goldEditModalSec form").attr('action', "{{ url('stores') }}");
            $("#goldEditModalSec form").find("input").val("");

            $("#goldEditModalSecTitle").text("新增入倉履歷");
            $('#goldEditModalSec').modal('show');
        }

        function edit_modalSec(obj) {
            let url = $(obj).data('url');
            let c_date = $(obj).data('c_date');
            let location = $(obj).data('location');
            let store_no = $(obj).data('store_no');
            console.log(url);
            console.log(c_date);
            console.log(location);
            console.log(store_no);

            //$("[name='order']").val(order);
            $("#goldEditModalSec form").attr('action', url);
            $("#goldEditModalSec form").find("[name='c_date']").val(c_date);
            $("#goldEditModalSec form").find("[name='location']").val(location);
            $("#goldEditModalSec form").find("[name='store_no']").val(store_no);
            $("#goldEditModalSec form").find("[name='_method']").val("PUT");
            $("#goldEditModalSecTitle").text("編輯入倉履歷");

            $('#goldEditModalSec').modal('show');
        }
    </script>
@endsection
