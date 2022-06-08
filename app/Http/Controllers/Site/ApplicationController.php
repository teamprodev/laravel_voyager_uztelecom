<?php

namespace App\Http\Controllers\Site;

use App\DataTables\DraftDataTable;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\VoteApplicationRequest;
use App\Jobs\VoteJob;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Services\ApplicationService;
use Illuminate\Support\Carbon;
use App\Models\SignedDocs;;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use TCG\Voyager\Models\Role;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
    /**
     * @var ApplicationService
     */
    private ApplicationService $service;

    public function __construct(ApplicationService $service){
        $this->middleware('auth');
        $this->service = $service;
    }

    public function show_status($status)
    {
        if($status == 'performed')
            $status = 'товар доставлен';
        Cache::put('status', $status);
        return view('site.applications.status');
    }

    public function status_table()
    {
        return $this->service->status_table();
    }
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function clone($id)
    {
        return $this->service->clone($id);
    }

    public function show(Application $application, $view = false)
    {
        if (isset($view)) {
            Notification::query()
                ->where('application_id', $application->id)
                ->where('user_id', auth()->id())
                ->increment('is_read');
        }
        return $this->service->show($application);
    }

    public function SignedDocs($application)
    {
        return $this->service->SignedDocs($application);
    }

    public function uploadImage(Request $request, Application $application)
    {
        return $this->service->uploadImage($request,$application);
    }

    public function create()
    {
        return $this->service->create();
    }

    public function edit(Application $application)
    {
            return $this->service->edit($application);
    }

    public function update(Application $application, ApplicationRequest $request)
    {
        return $this->service->update($application,$request);
    }
    public function show_draft(Request $request)
    {
        return $this->service->show_draft($request);
    }

    /**
     * soft delete post
     *
     * @return void
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->back();
    }
    public function is_more_than_limit(Application $application,Request $request)
    {
        $application->is_more_than_limit = $request->is_more_than_limit;
        $application->signers = null;
        $application->status = 'new';
        if($request->is_more_than_limit == 1)
        {
            $application->branch_initiator_id = 9;
        }
        $application->save();
        return redirect()->back();
    }
}
