<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('vendor.voyager.departments.browse');
    }
    public function getData()
    {
        $query = Department::query();
        return Datatables::of($query)
            ->editColumn('branch', function ($query) {
//                $name = $query->branch->name;
                $name = Branch::where('id', $query->branch_id)->get()->pluck('name')->toArray();
                return $name;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->addColumn('action', function($row){
                $edit_e = "/admin/departments/{$row->id}/edit";
                $destroy_e = route("voyager.departments.destroy",$row->id);
                $app_edit = __('Изменить');
                $app_delete= __('Посмотреть');;
                $bgcolor = setting('color.edit');
                $color = $bgcolor ? 'white':'black';
                $edit = "<a style='background-color: {$bgcolor};color: {$color}' href='{$edit_e}' class='m-1 col edit btn btn-sm'>$app_edit</a>";
                $bgcolor = setting('color.delete');
                $color = $bgcolor ? 'white':'black';
                $destroy = "<a style='background-color: {$bgcolor};color: {$color}' href='{$destroy_e}' class='m-1 col show btn btn-sm'>$app_delete</a>";
                return "<div class='row'>
                        {$edit}
                        {$destroy}
                        </div>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
