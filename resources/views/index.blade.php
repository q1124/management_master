@include('layouts.sidebar')
{{ $current_user->name }}
會員清單
<table>
    <thead>
    <th>客戶編號</th>
    <th>姓名</th>
    <th>狀態</th>
    <th>刪除</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->u_id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ ($user->email_verified_at == null)? '未開通' : '已開通' }}</td>
            <td>
                <form action="{{ url('users/'.$user->id) }}" method="post">
                    @method('DELETE')
                    <input type="submit" value="刪除">
                </form>
                {{--                <a href="{{ url('users/'.$user->id) }}">刪除</a>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--<form action="{{ url('/deposits/import') }}" method="post" enctype="multipart/form-data">--}}
{{--    預付金匯入--}}
{{--    <input type="file" name="file">--}}
{{--    <input type="submit">--}}
{{--</form>--}}

{{--<form action="{{ url('/stores/import') }}" method="post" enctype="multipart/form-data">--}}
{{--    入倉履歷匯入--}}
{{--    <input type="file" name="file">--}}
{{--    <input type="submit">--}}
{{--</form>--}}

{{--<form action="{{ url('/transports/import') }}" method="post" enctype="multipart/form-data">--}}
{{--    運輸紀錄匯入--}}
{{--    <input type="file" name="file">--}}
{{--    <input type="submit">--}}
{{--</form>--}}

{{--<form action="{{ url('/ships/import') }}" method="post" enctype="multipart/form-data">--}}
{{--    出貨明細匯入--}}
{{--    <input type="file" name="file">--}}
{{--    <input type="submit">--}}
{{--</form>--}}

Deposit預付金<br>
<table>
    <thead>
    <th>儲值日期</th>
    <th>儲值金額(台幣)</th>
    <th>使用匯率</th>
    <th>日幣金額</th>
    <th>備註</th>
    <th>刪除</th>
    </thead>
    <tbody>
    @foreach($current_user->deposits as $deposit)
        <tr>
            <td>{{ $deposit->c_date }}</td>
            <td>{{ $deposit->amount }}</td>
            <td>{{ $deposit->rate }}</td>
            <td>{{ $deposit->jpy }}</td>
            <td>{{ $deposit->note }}</td>
            <td>
                <form action="{{ url('deposits/'.$deposit->id) }}" method="post">
                    @method('DELETE')
                    <input type="submit" value="刪除">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

入倉履歷<br>
<table>
    <thead>
    <th>入倉日期</th>
    <th>國內運輸公司/取貨地點</th>
    <th>日本國內運輸公司追蹤單號</th>
    <th>刪除</th>
    </thead>
    <tbody>
    @foreach($current_user->stores as $store)
        <tr>
            <td>{{ $store->c_date }}</td>
            <td>{{ $store->location }}</td>
            <td><a href="{{ url('stores/'.$store->id) }}">{{ $store->store_no }}</a></td>
            <td>
                <form action="{{ url('stores/'.$store->id) }}" method="post">
                    @method('DELETE')
                    <input type="submit" value="刪除">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
