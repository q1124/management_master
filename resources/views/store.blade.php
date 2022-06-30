@extends('layouts.main')

@section('title','運輸紀錄')

@section('topBar')
   @if(Auth::user() ->role == 99)
    <a href="{{ url('admin')}}"><span class="previouspage">會員管理 / </span></a><a href="{{ url('member')}}"><span class="previouspage">{{ Auth::user()->name }} / </span></a><a href="{{ url('stores/'.$store->id) }}"><span class="sort-name">運輸紀錄</span></a>
    @else
    <a href="{{ url('member')}}"><span class="previouspage">首頁 / </span></a><a href="{{ url('stores/'.$store->id) }}"><span class="sort-name">運輸紀錄</span></a>
    @endif
@endsection

@section('content')
<!-- transport record -->
<div class="transport-record row col-lg-12">
    <!-- transport block  -->
    <div class="transport-block col-lg-12">
        <div class="transport-title">
            <h2>運輸紀錄： <span class="transport-num">{{ $store->store_no }}</span></h2>
            @if(Auth::user()->role == 99)
            <button class="btn transport-add vendor-btn" onclick="create_modal()">新增</button>
            @endif
        </div>
        <!-- table transport -->
        <table class="stored-table transport-information">
            <tbody class="infro-body">
                <tr class="stored-title infro-title gold-line transport-header">
                    <td>已入倉項目</td>
                    <td>JAN CODE</td>
                    <td>單價(¥)</td>
                    <td>重量(kg)</td>
                    <td>數量</td>
                    <td>金額小計(¥)</td>
                    <td>重量小計(kg)</td>
                    <td>預計離倉時間</td>
                    <td>國際貨運箱號</td>
                    <td>國際貨運追蹤號碼</td>
                </tr>
                <!-- transport data -->
                @foreach($store->transports as $transport)
                <tr class="stored-title infro-title gold-line">
                    <td>{{ $transport->name }}</td>
                    <td>{{ $transport->jan_code }}</td>
                    <td>{{ $transport->price }}</td>
                    <td>{{ $transport->weight }}</td>
                    <td>{{ $transport->amount }}</td>
                    <td>{{ $transport->price_total }}</td>
                    <td>{{ $transport->weight_total }}</td>
                    <td>{{ $transport->out_date }}</td>
                    <td>{{ $transport->box_no }}</td>
                    <td><a href="{{ url('transports/'.$transport->id) }}">{{ $transport->transport_no }}</a></td>
                    @if(Auth::user() -> role==99)
                    <td class="transport-btn vendor-btn">
                        <form action="{{ url('transports/'.$transport->id) }}" method="post">
                            <input type="button" value="編輯"
                                data-url="{{ url('transports/'.$transport->id) }}"
                                data-name="{{ $transport->name }}"
                                data-jan_code="{{ $transport->jan_code }}"
                                data-price="{{ $transport->price }}"
                                data-weight="{{ $transport->weight }}"
                                data-amount="{{ $transport->amount }}"
                                data-price_total="{{ $transport->price_total }}"
                                data-weight_total="{{ $transport->weight_total }}"
                                data-out_date="{{ $transport->out_date }}"
                                data-box_no="{{ $transport->box_no }}"
                                data-transport_no="{{ $transport->transport_no }}"
                                onclick="edit_modal(this)">
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
<!-- transport edit modal -->
<div class="modal edit-modal" id="transportEditModal" tabindex="-1" role="dialog"
    aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog edit-dialog " role="document">
        <div class="modal-content edit-content">
            <div class="modal-header edit-header">
                <h5 class="edit-title" id="transportEditModalTitle">編輯運輸紀錄</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- transport edit body -->
            <form action="" method="POST">
                @method("PUT")
                <div class="modal-body edit-body">
                    <span class="edit-data gold-data">
                        <p>已入倉項目</p><input type="text" name="name" value="" required>
                    </span>
                    <span class="edit-data">
                        <p>JAN CODE</p><input type="number" name="jan_code" value="" required>
                    </span>
                    <span class="edit-data gold-data unit-input">
                        <p>單價</p><input type="tel" name="price" value="" placeholder="¥" required>
                    </span>
                    <span class="edit-data gold-data unit-input">
                        <p>重量</p><input type="tel" name="weight" value="" placeholder="公斤" required>
                    </span>
                    <span class="edit-data gold-data unit-input">
                        <p>數量</p><input type="text" name="amount" value="" required>
                    </span>
                    <span class="edit-data gold-data unit-input">
                        <p>金額小計</p><input type="text" name="price_total" value="" placeholder="¥" required>
                    </span>
                    <span class="edit-data gold-data unit-input">
                        <p>重量小計</p><input type="text" name="weight_total" value="" placeholder="公斤" required>
                    </span>
                    <span class="edit-data gold-data">
                        <p>預計離倉時間</p><input type="text" name="out_date" value="" required>
                    </span>
                    <span class="edit-data gold-data">
                        <p>國際貨運箱號</p><input type="text" name="box_no" value="" required>
                    </span>
                    <span class="edit-data gold-data">
                        <p>國際貨運追蹤號碼</p><input type="text" name="transport_no" value="" required>
                    </span>
                    <input type="text" name="store_id" value="{{ $store->store_no }}" hidden>
                </div>
                <!-- transport edit submit -->
                <div class="modal-footer edit-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">關閉</button>
                    <button type="submit" class="btn btn-primary">儲存變更</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function create_modal() {
        $("#transportEditModal form").attr('action', "{{ url('transports') }}");
        $("#transportEditModal form").find("input").val("");
        $("#transportEditModal form").find("[name='store_id']").val("{{ $store->store_no }}");
        $("#transportEditModalTitle").text("新增運輸紀錄");
        $('#transportEditModal').modal('show');
    }

    function edit_modal(obj) {
        let url = $(obj).data('url');
        let name = $(obj).data('name');
        let jan_code = $(obj).data('jan_code');
        let price = $(obj).data('price');
        let weight = $(obj).data('weight');
        let amount = $(obj).data('amount');
        let price_total = $(obj).data('price_total');
        let weight_total = $(obj).data('weight_total');
        let out_date = $(obj).data('out_date');
        let box_no = $(obj).data('box_no');
        let transport_no = $(obj).data('transport_no');

        //$("[name='order']").val(order);
        $("#transportEditModal form").attr('action', url);
        $("#transportEditModal form").find("[name='name']").val(name);
        $("#transportEditModal form").find("[name='jan_code']").val(jan_code);
        $("#transportEditModal form").find("[name='price']").val(price);
        $("#transportEditModal form").find("[name='weight']").val(weight);
        $("#transportEditModal form").find("[name='amount']").val(amount);
        $("#transportEditModal form").find("[name='price_total']").val(price_total);
        $("#transportEditModal form").find("[name='weight_total']").val(weight_total);
        $("#transportEditModal form").find("[name='out_date']").val(out_date);
        $("#transportEditModal form").find("[name='box_no']").val(box_no);
        $("#transportEditModal form").find("[name='transport_no']").val(transport_no);
        $("#transportEditModal form").find("[name='_method']").val("PUT");
        $("#transportEditModalTitle").text("編輯運輸明細");

        $('#transportEditModal').modal('show');
    }
</script>
@endsection

