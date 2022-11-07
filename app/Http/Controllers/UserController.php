<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
// use Yajra\DataTables\WithExportQueue;
class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','name','email')->get();
            return DataTables::of($data)->addColumn('link', 'view')
            ->addColumn('action', 'delete')
            ->setRowId(function ($user) {
                return $user->id;
            })->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })->addColumn('aaa', function($row){
                $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                return $btn;
            }) ->rawColumns(['aaa'])
            ->toJson();
        }

        return view('users');
    }
}
