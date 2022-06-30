<?php

namespace App\Http\Controllers;

use App\Imports\DepositImport;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{

    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public');

        dd($path);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);

    }

}
