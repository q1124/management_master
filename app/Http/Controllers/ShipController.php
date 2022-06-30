<?php

namespace App\Http\Controllers;

use App\Imports\ShipImport;
use App\Models\Ship;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $ships = Ship::whereTransportId($request['transport_id'])->get();
        return view('ship', compact('ships'));
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

        $model = new Ship;
        $model->fill($data);
        $model->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        //
        $ship->fill($request->all())->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        //
        $ship->delete();
        return back();
    }

    public function import(Request $request)
    {
        Excel::import(new ShipImport, $request->file('file'));

        return back();
    }
}
