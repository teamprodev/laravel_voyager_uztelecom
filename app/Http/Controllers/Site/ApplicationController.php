<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\StatusExtented;
use App\Services\ApplicationService;
use App\Models\SignedDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon as Date;
use Illuminate\Support\Facades\File;
use App\Services\ApplicationData;

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
        $voyager = Setting::where('key','admin.show_status')->first();
        $voyager->value = $status;
        $voyager->save();
        return view('site.applications.status');
    }
    /**
     * Performer Statusda bo'lgan Applicationlarni ko'rsatish
    */
    public function performer_status_get(Request $req)
    {
        $status = StatusExtented::pluck('name','id')->toArray();
        return view('site.applications.performer_status',compact('status'));
    }
    public function performer_status_post(Request $req)
    {
        Cache::put('performer_status_get', $req->performer_status_get);
        return redirect()->route('site.applications.performer_status_get');
    }
    public function status_table()
    {
        $user = auth()->user();
        return $this->service->status_table($user);
    }
    public function performer_status()
    {
        $user = auth()->user();
        return $this->service->performer_status($user);
    }
    /**
     * All Application
     *
     * Hamma Applicationlar(Zayavkalar)
    */
    public function index(Request $request)
    {
        $user = auth()->user();
        return $this->service->index($request,$user);
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
                ->update(['is_read' => 1]);
        }
        return $this->service->show($application, auth()->user());
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
        $user = auth()->user();
        return $this->service->create($user);
    }
    /**
     * Application Edit
    */
    public function edit(Application $application)
    {
        $user = auth()->user();
        if(((($application->performer_role_id !== null) && ($application->performer_role_id !== auth()->user()->role_id)) && $user->hasPermission('Warehouse')) || ((($application->show_leader === 2) && ($application->performer_role_id !== auth()->user()->role_id)) && $user->hasPermission('Warehouse')))
        {
            abort(405,__("Вам нельзя изменить заявку,ибо заявка уже подписана!"));
        }
        return $this->service->edit($application);
    }
    /**
     * Application Update
    */
    public function update(Application $application, ApplicationRequest $request)
    {
        $user = auth()->user();
        return $this->service->update($application,$request,$user);
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
        $application->delete_from = auth()->user()->id;
        $application->save();
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
        $this->service->is_more_than_limit($application,$request);
        return redirect()->back();
    }
    public function to_sign()
    {
        return view('site.applications.to_sign');
    }
    public function to_sign_data()
    {
        $user = auth()->user();
        return $this->service->to_sign_data($user);
    }
    /*
        File delete
    */
    public function file_delete(Request $request, Application $application,$column)
    {
        $file = json_decode($application->$column);
        $delete = array_diff($file,[$request->file]);
        $application->$column = $delete;
        $application->save();
        $file = public_path()."/storage/uploads/{$request->file}";
        $date_now = Date::now();
        $date_now = str_replace([' ',':', '/'], '-',$date_now);
        $file_ext =  pathinfo($file, PATHINFO_EXTENSION);
        $file_rename = str_replace($file_ext, '',$request->file);
        File::move($file, public_path()."/storage/backups/{$file_rename}".$date_now.'.'.$file_ext);
        return redirect()->back();
    }
    public function change_status()
    {
        $applications = Application::where('performer_role_id','!=',null)->where('status',ApplicationData::Status_In_Process)->get();
        foreach ($applications as $application) {
            $application->status = ApplicationData::Status_Distributed;
            $application->show_leader = 2;
            $application->save();
        }

        $signed_docs = Application::where('draft','!=',1)->get();
        foreach ($signed_docs as $docs) {
            $signedDocsId = SignedDocs::where('application_id',$docs->id)->get();

            $agreedUsers = $signedDocsId->where('status', 1)->map(function ($doc) {
                if (isset($doc->role_id)) {
                    $role_id = $doc->role_id;
                    return $role_id;
                }
            });
            $canceledUsers = $signedDocsId->where('status', 0)->whereNotNull('status')->map(function ($doc) {
                $role_id = $doc->role_id;
                return $role_id;
            });
            $roles_need_sign = json_decode($docs->signers);
            switch (true){
                case in_array(7, $agreedUsers->toArray()) && $docs->status === ApplicationData::Status_In_Process:
                    $docs->status = ApplicationData::Status_Agreed;
                    $docs->show_director = 2;
                    $docs->show_leader = 1;
                    break;
                case count(array_diff($roles_need_sign, $agreedUsers->toArray())) === 1 && $docs->is_more_than_limit === 1 && $docs->show_leader === null && $docs->status === ApplicationData::Status_In_Process :
                    $docs->show_director = 1;
                    $docs->status = ApplicationData::Status_In_Process;
                    break;
                case  array_diff($roles_need_sign, $agreedUsers->toArray()) === null && $docs->is_more_than_limit !== 1 && $docs->show_leader === null && $docs->status === ApplicationData::Status_In_Process :
                    $docs->show_leader = 1;
                    $docs->status = ApplicationData::Status_In_Process;
                    break;
                case array_diff($roles_need_sign, $agreedUsers->toArray()) !== null && $docs->show_leader === 1 && $docs->status === ApplicationData::Status_In_Process :
                    $docs->show_leader = null;
                    $docs->performer_role_id = null;
                    $docs->performer_received_date = null;
                    $docs->performer_comment = null;
                    $docs->performer_comment_date = null;
                    break;
                case  in_array(7, $canceledUsers->toArray()) && $docs->show_leader === null :
                    $docs->status = ApplicationData::Status_Rejected;
                    break;
            }
            $docs->save();
        }
    }
}
