出貨明細<br>
<table>
    <thead>
    <th>日本國內運輸單號</th>
    </thead>
    @foreach($ships as $ship)
        <tr>
            <td>{{ $ship->transport_id }}</td>
            <td>{{ $transport->tw_no }}</td>
            <td>{{ $transport->weight }}</td>
            <td>{{ $transport->price_buy }}</td>
            <td>{{ $transport->price_ship }}</td>
            <td>{{ $transport->price_total }}</td>
            <td>{{ $transport->attachment_id }}</td>
        </tr>
    @endforeach
</table>
