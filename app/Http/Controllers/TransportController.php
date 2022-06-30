<?php

namespace App\Http\Controllers;

use App\Imports\TransportImport;
use App\Models\Transport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $transports = Transport::whereStoreId($request['store_id'])->get();
        return view('transport', compact('transports'));
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
        $data = $request->except("_method");
        $current_user = \Session::get('admin_user');
        $data['user_id'] = $current_user->id;

        $model = new Transport;
        $model->fill($data);
        $model->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
        return view('transport',compact('transport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        //
        $transport->fill($request->all())->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        //
        $transport->delete();
        return back();
    }

    public function import(Request $request)
    {
        Excel::import(new TransportImport, $request->file('file'));

        return back();
    }
}
