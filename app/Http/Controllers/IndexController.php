<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $current_user = \Auth::user();

        $query = User::query();
        $columns = ['name'];
        foreach ($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $request['search'] . '%');
        }
        $users = $query->get();

        return view('index', compact('current_user', 'users'));
    }

    public function setMember(Request $request)
    {
        $data = $request->all();

        $current_user = User::find($data['user_id']);
        \Session::put('admin_user', $current_user);
        return redirect('/member');
    }

    public function admin(Request $request)
    {
        $query = User::query();
        $columns = ['name'];
        foreach ($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $request['search'] . '%');
        }
        $query->where('role','!=',99);
        $users = $query->get();

        return view('admin', compact('users'));
    }

    public function member(Request $request)
    {
        $current_user = \Session::get('admin_user');
        $current_user = User::find($current_user->id);

        $use_datas = [];
        $total_use = 0;
        foreach ($current_user->stores as $store) {
            foreach ($store->transports as $transport) {
                $total = 0;
                foreach ($transport->ships as $ship) {
                    $total = $total + $ship->price_total;
                }
                $use_datas[] = [
                    'use_date' => $store->c_date,
                    'order_no' => $transport->transport_no,
                    'total' => $total
                ];
                $total_use = $total_use + $total;
            }
//            $use_data[] = [
//                'user_date' => $store->c_date,
//                'order_no' => $store->store_no,
//            ];
        }

        return view('member', compact('current_user', 'use_datas', 'total_use'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Wishlist $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Wishlist $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wishlist $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Wishlist $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
