<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class DepartmentService
{
    /**
     * Barcha Department ya'ni Otdellarni chiqazish.
     **/
    public function getData($query)
    {
        return Datatables::of($query)
            ->editColumn('branch', function ($query) {
                $name = Branch::where('id', $query->branch_id)->get()->pluck('name')->toArray();
                return $name;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->addColumn('action', function ($row) {
                $data['edit'] = "/admin/departments/{$row->id}/edit";
                $data['destroy'] = route("voyager.departments.destroy", $row->id);
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
