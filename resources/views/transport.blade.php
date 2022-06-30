@extends('layouts.main')

@section('title','出貨明細')

@section('topBar')
    @if(Auth::user()->role == 99)
    <a href="{{ url('admin')}}"><span class="previouspage">會員管理 / </span></a><a href="{{ url('member')}}"><span class="previouspage">{{ Auth::user()->name }} / </span></a><a href="javascript:history.back()"><span class="previouspage">運輸紀錄 / </span></a>
    <span class="sort-name">出貨明細</span>
    @else
    <a href="{{ url('member')}}"><span class="previouspage">首頁 / </span></a><a href="javascript:history.back()"><span class="previouspage">運輸紀錄 / </span></a><span class="sort-name">出貨明細</span>
    @endif
@endsection

@section('content')
    <!-- shipment details -->
    <div class="shipment-details row col-lg-12">
        <!-- shipment block  -->
        <div class="shipment-block col-lg-12">
            <div class="shipment-title">
                <h2>運輸紀錄： <span class="shipment-num">{{ $transport->transport_no }}</span></h2>
                @if(Auth::user()->role == 99)
                <button class="btn shipment-add vendor-btn" onclick="create_modal()">新增</button>
                @endif
            </div>
            <!-- table shipment -->
            <table class="stored-table shipment-information">
                <tbody class="infro-body">
                    <tr class="infro-title gold-line shipment-header">
                        <td>台灣國內單號</td>
                        <td>包裹總重量(kg)</td>
                        <td>購物金額(NTD)</td>
                        <td>運費金額(NTD)</td>
                        <td>金額總計(NTD)</td>
                        <td>附件查詢</td>
                    </tr>
                    <!-- shipment data -->
                    @foreach($transport->ships as $ship)
                        <tr class="infro-title gold-line">
                            <td>{{ $ship->tw_no }}</td>
                            <td>{{ $ship->weight }}</td>
                            <td>{{ $ship->price_buy }}</td>
                            <td>{{ $ship->price_ship }}</td>
                            <td>{{ $ship->price_total }}</td>
                            <td>
                                @foreach($ship->attachments as $attachment)
                                    <div class="shipment-delete" style="display: flex;align-items:center;">
                                    <a href="{{ asset('storage/'.$attachment->path)  }}" target="_blank">{{ $attachment->name }}</a>
                                    @if(Auth::user()->role==99)
                                        <form style="margin-bottom:0px" action="{{ url('attachments/'.$attachment->id) }}" method="post">
                                            @method('DELETE')
                                            <input style="background-color: unset;font-size: 10px;color: #000;border: unset;border-radius: 4px;" type="submit" value="X">
                                        </form>
                                    @endif
                                    </div>
                                <br>
                                @endforeach
                                @if(Auth::user() ->role ==99)
                                    <a onclick='$(this).parent().find("[name=\"file\"]").click()'>上傳</a>
                                    <form action="{{ url('/attachments/upload?ship_id='.$ship->id) }}" method="post" enctype="multipart/form-data" hidden>
                                        <input type="file" name="file" onchange="$(this).parent().submit()">
                                        <input type="submit">
                                    </form>
                                @endif
                            </td>
                            @if(Auth::user()->role==99)
                            <td class="shipment-btn vendor-btn">
                                <form action="{{ url('ships/'.$ship->id) }}" method="post">
                                    <input type="button" value="編輯"
                                           data-url="{{ url('ships/'.$ship->id) }}"
                                           data-tw_no="{{ $ship->tw_no }}"
                                           data-weight="{{ $ship->weight  }}"
                                           data-price_buy="{{ $ship->price_buy }}"
                                           data-price_ship="{{ $ship->price_ship }}"
                                           data-price_total="{{ $ship->price_total }}"
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
    <!-- shipmen edit modal -->
    <div class="modal edit-modal" id="shipmentEditModal" tabindex="-1" role="dialog"
         aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog edit-dialog " role="document">
            <div class="modal-content edit-content">
                <div class="modal-header edit-header">
                    <h5 class="edit-title" id="shipmentEditModalTitle">編輯出貨明細</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- shipmen edit body -->
                <form action="" method="POST">
                    @method("PUT")
                    <div class="modal-body edit-body">
                        <span class="edit-data gold-data">
                            <p>台灣國內單號</p><input type="text" name="tw_no" value="" required>
                        </span>
                        <span class="edit-data unit-input">
                            <p>包裹總重量</p><input type="text" name="weight" value="" placeholder="公斤" required>
                        </span>
                        <span class="edit-data gold-data unit-input">
                            <p>購物金額</p><input type="tel" name="price_buy" value="" placeholder="台幣" required>
                        </span>
                        <span class="edit-data gold-data unit-input">
                            <p>運費金額</p><input type="tel" name="price_ship" value="" placeholder="台幣" required>
                        </span>
                        <span class="edit-data gold-data unit-input">
                            <p>金額總計	</p><input class="form-control" type="tel" name="price_total" value="" placeholder="台幣" required>
                        </span>
                        <input type="text" name="transport_id" value="" hidden>
                    </div>
                    <!-- shipmen edit submit -->
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
            $("#shipmentEditModal form").attr('action', "{{ url('ships') }}");
            $("#shipmentEditModal form").find("input").val("");
            $("#shipmentEditModal form").find("[name='transport_id']").val("{{ $transport->transport_no }}");
            $("#shipmentEditModalTitle").text("新增出貨明細");
            $('#shipmentEditModal').modal('show');
        }

        function edit_modal(obj) {
            let url = $(obj).data('url');
            let tw_no = $(obj).data('tw_no');
            let weight = $(obj).data('weight');
            let price_buy = $(obj).data('price_buy');
            let price_ship = $(obj).data('price_ship');
            let price_total = $(obj).data('price_total');

            //$("[name='order']").val(order);
            $("#shipmentEditModal form").attr('action', url);
            $("#shipmentEditModal form").find("[name='tw_no']").val(tw_no);
            $("#shipmentEditModal form").find("[name='weight']").val(weight);
            $("#shipmentEditModal form").find("[name='price_buy']").val(price_buy);
            $("#shipmentEditModal form").find("[name='price_ship']").val(price_ship);
            $("#shipmentEditModal form").find("[name='price_total']").val(price_total);
            $("#shipmentEditModal form").find("[name='transport_id']").val("{{ $transport->transport_no }}");
            $("#shipmentEditModal form").find("[name='_method']").val("PUT");
            $("#shipmentEditModalTitle").text("編輯出貨明細");

            $('#shipmentEditModal').modal('show');
        }
    </script>
@endsection
