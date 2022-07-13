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
use App\Models\StatusExtented;
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

    public function __construct(ApplicationService $service)
    {
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
    /**
     * Performer Statusda bo'lgan Applicationlarni ko'rsatish 
    */ 
    public function performer_status_get(Request $req)
    {
        $status = StatusExtented::pluck('name','name')->toArray();
        return view('site.applications.performer_status',compact('status'));
    }
    public function performer_status_post(Request $req)
    {
        Cache::put('performer_status_get', $req->performer_status_get);
        return redirect()->route('site.applications.performer_status_get');
    }
    public function status_table()
    {
        return $this->service->status_table();
    }
    public function performer_status()
    {
        return $this->service->performer_status();
    }
    /**
     * All Application
     * 
     * Hamma Applicationlar(Zayavkalar)
    */ 
    public function index(Request $request)
    {
        return $this->service->index($request);
    }
    /**
     * Application Clone(Nusxalash)  
    */ 
    public function clone($id)
    {
        $this->middleware('application_clone');
        return $this->service->clone($id);
    }
    /**
     * Application Show
    */ 
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
    /**
     * @var application ga tegishli bolgan SignedDocs
    */ 
    public function SignedDocs($application)
    {
        $data = SignedDocs::where('application_id',$application);
        return $this->service->SignedDocs($data);
    }
    /**
     * Application Image Upload 
    */ 
    public function uploadImage(Request $request, Application $application)
    {
        return $this->service->uploadImage($request,$application);
    }
    /**
     * Application Create
    */ 
    public function create()
    {
        return $this->service->create();
    }
    /**
     * Application Edit
    */ 
    public function edit(Application $application)
    {
            return $this->service->edit($application);
    }
    /**
     * Application Update
    */ 
    public function update(Application $application, ApplicationRequest $request)
    {
        return $this->service->update($application,$request);
    }
    /**
     * Chernovik bo'lgan applicationlarni ko'rish
    */ 
    public function show_draft(Request $request)
    {
        return $this->service->show_draft($request);
    }
    /**
     * soft delete post
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->back();
    }
    /**
     * application is_more_than_limit update
     * 
     * application is_more_than_limit update qilinishi
     * kelayotgan request ga qarab company yoki filialga ketishi
     * agar request 1 kelsa bu company dan ketadi va application branch_initiator_id 9 ga ozgaradi. 
     * Chunki 9 id bu Company AK UZBEKTELECOM
     * 
     * Kelayotgan request 0 bo'lsa unda shu applicationni create qilgan userni filiali branch_initiator_id ga tushadi.
     */
    public function is_more_than_limit(Application $application,Request $request)
    {
        $application->is_more_than_limit = $request->is_more_than_limit;
        $application->signers = null;
        $application->status = 'new';
        if($request->is_more_than_limit == 1)
        {
            $application->is_more_than_limit = 1;
            $application->branch_initiator_id = 9;
        }
        if($application->branch_initiator_id == 9 && $application->user_id == 9)
        {
            $application->is_more_than_limit = 1;
        }
        SignedDocs::where('application_id',$application->id)->delete();
        $application->save();
        return redirect()->back();
    }
    /*
        File delete
    */ 
    public function file_delete(Request $request)
    {
        $file = public_path()."/storage/uploads/{$request->file}";
        unlink($file);
        return redirect()->back();
    }
}
