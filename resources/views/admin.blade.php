@extends('layouts.main')

@section('title','會員管理')

@section('topBar')
    <a href="{{ url('admin')}}"><span class="previouspage">會員管理</span></a>
@endsection

@section('content')
    <!-- member index record -->
    <div class="member-index-record row col-lg-12">
        <!-- member index block  -->
        <div class="member-index-block col-lg-12">
            <div class="member-index-title input-group rounded">
                <form action="{{ url('admin') }}" class="d-flex">
                <span class="input-group-text border-0" id="search-addon">
                    <img src="{{ asset('css/image/search.png') }}" alt="">
                </span>
                <input name="search" class="form-control rounded member-search" placeholder="搜尋客戶姓名..."
                       aria-label="Search" aria-describedby="search-addon"/>
                </form>
            </div>
            <!-- table member index -->
            <table class="stored-table member-index-information">
                <tbody class="infro-body">
                <tr class="infro-title gold-line member-index-header">
                    <td>客戶編號</td>
                    <td>客戶姓名</td>
                    <td>狀態</td>
                </tr>
                <!-- member index data-01 -->
                <tbody>
                @foreach($users as $user)
                    <tr class="infro-title gold-line">
                        <td>{{ $user->u_id }}</td>
                        <td><a href="{{ url('/setMember?user_id='.$user->id) }}">{{ $user->name }}</td>
                        <td>{{ ($user->email_verified_at == null)? '未開通' : '已開通' }}</td>
                        <td class="member-index-btn">
                            <form action="{{ url('users/'.$user->id) }}" method="post">
                                @method('DELETE')
                                <input type="submit" value="刪除">
                            </form>
                            {{--<a href="{{ url('users/'.$user->id) }}">刪除</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
