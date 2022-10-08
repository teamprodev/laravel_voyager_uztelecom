<?php


namespace App\Services;


use App\Enums\ApplicationMagicNumber;
use App\Enums\ApplicationStatusEnum;
use App\Enums\PermissionEnum;
use App\Events\Notify;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Notification;
use App\Models\PermissionRole;
use App\Models\Position;
use App\Models\Purchase;
use App\Models\Resource;
use App\Models\Roles;
use App\Models\SignedDocs;
use App\Models\StatusExtended;
use App\Models\Subject;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ApplicationService
{
    /*
     * Permissionlarga qarab Applicationlar chiqishi
     */
    public function index_getData($user)
    {
        if ($user->hasPermission('Purchasing_Management_Center')) {
            $application = Application::where('draft', '!=', ApplicationMagicNumber::one)->where('branch_initiator_id', '!=', null);
        } elseif ($user->hasPermission('Company_Leader') | $user->hasPermission('Branch_Leader')) {
            $a = 'branch_initiator_id';
            $b = [$user->branch_id];
            $application = Application::where('draft', '!=', ApplicationMagicNumber::one)->whereIn($a, $b);
        } else {
            $a = 'department_initiator_id';
            $b = [$user->department_id];
            $application = Application::where('draft', '!=', ApplicationMagicNumber::one)->whereIn($a, $b);
        }

        switch ($user->hasPermission('Purchasing_Management_Center') == false) {
            case $user->hasPermission('Add_Company_Signer') && $user->hasPermission('Add_Branch_Signer') :
                $query = $application->orWhere('signers', 'like', "%{$user->role_id}%")->where('draft', '!=', ApplicationMagicNumber::one)->orWhere('performer_role_id', $user->role->id)->where('draft', '!=', ApplicationMagicNumber::one)->orWhere('user_id', $user->id)->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            case $user->hasPermission(PermissionEnum::Warehouse) :
                $status = ApplicationStatusEnum::Accepted;
                $query = $application->where('status', 'like', "%{$status}%")->orWhere('user_id', $user->id)->get();
                break;
            case $user->hasPermission('Company_Leader') && $user->hasPermission('Branch_Leader') :
                $query = $application->orWhere('user_id', $user->id)->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            case $user->role_id === ApplicationMagicNumber::Director:
                $query = $application->get();
                break;
            case $user->hasPermission('Company_Signer') || $user->hasPermission('Add_Company_Signer') || $user->hasPermission('Branch_Signer') || $user->hasPermission('Add_Branch_Signer'):
                $query = Application::where('draft', '!=', ApplicationMagicNumber::one)
                    ->where('signers', 'like', "%{$user->role_id}%")
                    ->orWhere('performer_role_id', $user->role->id)
                    ->where('draft', '!=', ApplicationMagicNumber::one)
                    ->orWhere('user_id', $user->id)
                    ->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            case $user->hasPermission('Company_Leader') :
                $query = $application->where('status', ApplicationStatusEnum::Agreed)->orWhere('status', ApplicationStatusEnum::Distributed)->whereIn($a, $b)->where('draft', '!=', ApplicationMagicNumber::one)->orWhere('user_id', $user->id)->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            case $user->hasPermission('Branch_Leader') :
                $query = $application->where('is_more_than_limit', ApplicationMagicNumber::zero)->where('show_leader', ApplicationMagicNumber::one)->orWhere('is_more_than_limit', ApplicationMagicNumber::zero)->whereIn($a, $b)->where('status', ApplicationStatusEnum::New)->orWhere('is_more_than_limit', ApplicationMagicNumber::zero)->where('draft', '!=', ApplicationMagicNumber::one)->whereIn($a, $b)->where('status', ApplicationStatusEnum::Distributed)->orWhere('user_id', $user->id)->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            case $user->hasPermission('Company_Performer') || $user->hasPermission('Branch_Performer') :
                $query = Application::where('performer_role_id', $user->role_id)->orWhere('user_id', $user->id)->where('draft', '!=', ApplicationMagicNumber::one)->get();
                break;
            default :
                $query = $application->get();
                break;
        }
        return Datatables::of($query)
            ->editColumn('is_more_than_limit', function ($query) {
                return $query->is_more_than_limit == ApplicationMagicNumber::one ? __('Компанию') : __('Филиал');
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new Carbon($query->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('branch_initiator_id', function ($query) {
                return $query->branch->name;
            })
            ->editColumn('planned_price', function ($query) {
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('date', function ($query) {
                return $query->date ? with(new Carbon($query->date))->format('d.m.Y') : '';
            })
            ->editColumn('delivery_date', function ($query) {
                return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d.m.Y') : '';
            })
            ->addColumn('planned_price_curr', function ($query) {
                $planned_price = $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
                return "{$planned_price}  {$query->currency}";
            })
            ->editColumn('status', function ($query) {
                /*
                 *  Voyager admin paneldan status ranglarini olish va chiqarish
                 */
                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtended::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color, 'app' => $this->translateStatus($status), 'color' => $color ? 'white' : 'black']);
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if (auth()->user()->id === $row->user_id || auth()->user()->hasPermission(PermissionEnum::Warehouse) || $row->performer_role_id === auth()->user()->role_id) {
                    $data['edit'] = route('site.applications.edit', $row->id);
                }

                $data['show'] = route('site.applications.show', $row->id);

                if ($row->user_id === auth()->user()->id && $row->show_director !== ApplicationMagicNumber::two && $row->show_leader !== ApplicationMagicNumber::two && $row->status !== ApplicationStatusEnum::Refused) {
                    $data['destroy'] = route('site.applications.destroy', $row->id);
                }

                if (($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Rejected)) {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /*
     * User tanlagan statusdagi Applicationlarni chiqarish
     */
    public function status_table($user)
    {
        if ($user->hasPermission('Purchasing_Management_Center')) {
            $application = Application::where('branch_initiator_id', '!=', null);
        } else {
            $application = Application::where('branch_initiator_id', $user->branch_id);
        }
        $status = setting('admin.show_status');
        $data = $application->where('status', $status)->get();
        return Datatables::of($data)
            ->editColumn('is_more_than_limit', function ($query) {
                return $query->is_more_than_limit == ApplicationMagicNumber::one ? __('Компанию') : __('Филиал');
            })
            ->editColumn('branch_initiator_id', function ($query) {
                return $query->branch->name;
            })
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('planned_price', function ($query) {
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
            })
            ->editColumn('delivery_date', function ($query) {
                return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->addColumn('planned_price_curr', function ($query) {
                $planned_price = $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
                return "{$planned_price}  {$query->currency}";
            })
            ->editColumn('status', function ($query) {
                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtended::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color, 'app' => $this->translateStatus($status), 'color' => $color ? 'white' : 'black']);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if(auth()->user()->id === $row->user_id || auth()->user()->hasPermission(PermissionEnum::Warehouse) || $row->performer_role_id === auth()->user()->role_id)
                {
                    $data['edit'] = route('site.applications.edit', $row->id);
                }

                $data['show'] = route('site.applications.show', $row->id);

                if($row->user_id == auth()->user()->id)
                {
                    $data['destroy'] = route('site.applications.destroy', $row->id);
                }

                if(($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Refused)||($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Rejected))
                {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /*
     * User tanlagan Performer_Statusga qarab Applicationlar show bo'lishi
     * */
    public function performer_status($user)
    {
        if ($user->hasPermission('Purchasing_Management_Center')) {
            $application = Application::Where('branch_initiator_id', '!=', null);
        } else {
            $application = Application::where('branch_initiator_id', $user->branch_id);
        }
        $status = Cache::get('performer_status_get');
        $data = $application->where('performer_status', $status)->get();
        return Datatables::of($data)
            ->editColumn('is_more_than_limit', function ($query) {
                return $query->is_more_than_limit == ApplicationMagicNumber::one ? __('Компанию') : __('Филиал');
            })
            ->editColumn('branch_initiator_id', function ($query) {
                return $query->branch->name;
            })
            ->addIndexColumn()
            ->editColumn('user_id', function($docs) {
                return $docs->user ? $docs->user->name:"";
            })
            ->editColumn('role_id', function($docs) {
                return $docs->role ? $docs->role->display_name:"";
            })
            ->editColumn('planned_price', function ($query) {
                return $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
            })
            ->editColumn('delivery_date', function ($query) {
                return $query->updated_at ? with(new Carbon($query->delivery_date))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->addColumn('planned_price_curr', function ($query) {
                $planned_price = $query->planned_price ? number_format($query->planned_price, ApplicationMagicNumber::zero, '', ' ') : '';
                return "{$planned_price}  {$query->currency}";
            })
            ->editColumn('status', function ($query) {
                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtended::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color, 'app' => $this->translateStatus($status), 'color' => $color ? 'white' : 'black']);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if(auth()->user()->id === $row->user_id || auth()->user()->hasPermission(PermissionEnum::Warehouse) || $row->performer_role_id === auth()->user()->role_id)
                {
                    $data['edit'] = route('site.applications.edit', $row->id);
                }

                $data['show'] = route('site.applications.show', $row->id);

                if($row->user_id == auth()->user()->id)
                {
                    $data['destroy'] = route('site.applications.destroy', $row->id);
                }

                if(($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Refused)||($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Rejected))
                {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /*
     * Application Clone(Nusxalash)
     */
    public function clone($id)
    {
        $clone = Application::findOrFail($id);
        $application = $clone->replicate();
        $application->signers = null;
        $application->status = ApplicationStatusEnum::New;
        $application->save();
        return redirect()->back();
    }

    public function SignedDocs($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user ? $docs->user->name : "";
            })
            ->editColumn('role_id', function ($docs) {
                return $docs->role ? $docs->role->display_name : "";
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at ? with(new Carbon($query->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('status', function ($status) {
                $status_agreed = __('agreed');
                $status_rejected = __('rejected');
                $status_not_signed = __('Не подписан');

                match ($status->status) {
                    0 => $status_signer = $status_rejected,
                    1 => $status_signer = $status_agreed,
                    default => $status_signer = $status_not_signed,
                };
                return $status_signer;
            })
            ->make(true);
    }

    /*
     * Application Create
     */
    public function create($user)
    {
        $application = new Application();
        $application->user_id = $user->id;
        $application->branch_initiator_id = $user->branch_id;
        $application->branch_id = $user->branch_id;
        $application->department_initiator_id = $user->department_id;
        $application->status = ApplicationStatusEnum::New;
        $application->save();
        return redirect()->route('site.applications.edit', $application->id);
    }

    /*
     * Draft(Chernovik) Applicationlarni chiqazish
     */
    public function show_draft_getData($user)
    {
        $data = Application::where('user_id', $user->id)
            ->whereDraft(ApplicationMagicNumber::one);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->addColumn('action', function ($row) {
                $data['edit'] = route('site.applications.edit', $row->id);
                $data['show'] = route('site.applications.show', $row->id);
                $data['destroy'] = route('site.applications.destroy', $row->id);
                if ($row->status === ApplicationStatusEnum::Accepted || $row->status === ApplicationStatusEnum::Refused) {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }

                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /*
     * Image upload
     */
    public function uploadImage($request, $application)
    {
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        if ($request->hasFile('file_basis')) {
            $fileName = time() . '_' . $request->file_basis->getClientOriginalName();
            $filePath = $request->file('file_basis')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_basis[] = $fileName;
        }
        if ($request->hasFile('file_tech_spec')) {
            $fileName = time() . '_' . $request->file_tech_spec->getClientOriginalName();
            $filePath = $request->file('file_tech_spec')
                ->move(public_path("storage/uploads/"), $fileName);

            $file_tech_spec[] = $fileName;
        }
        if ($request->hasFile('other_files')) {
            $fileName = time() . '_' . $request->other_files->getClientOriginalName();
            $filePath = $request->file('other_files')
                ->move(public_path("storage/uploads/"), $fileName);

            $other_files[] = $fileName;
        }
        if ($request->hasFile('performer_file')) {
            $fileName = time() . '_' . $request->performer_file->getClientOriginalName();
            $filePath = $request->file('performer_file')
                ->move(public_path("storage/uploads/"), $fileName);

            $performer_file[] = $fileName;
        }

        $application->file_basis = json_encode($file_basis);
        $application->performer_file = json_encode($performer_file);
        $application->file_tech_spec = json_encode($file_tech_spec);
        $application->other_files = json_encode($other_files);
        $application->update();
    }

    public function show($application, $user)
    {
        $access = SignedDocs::where('role_id', auth()->user()->role_id)->where('status', null)->where('application_id', $application->id)->first();
        $check = SignedDocs::where('role_id', auth()->user()->role_id)->where('application_id', $application->id)->first();
        $branch = Branch::where('id', $application->branch_initiator_id)->first();
        $signedDocs = $application->signedDocs()->get();
        $file_basis = json_decode($application->file_basis);
        $file_tech_spec = json_decode($application->file_tech_spec);
        $other_files = json_decode($application->other_files);
        $performer_file = json_decode($application->performer_file);
        $same_role_user_ids = User::where('role_id', auth()->user()->role_id)->get()->pluck('id')->toArray();

        /*
         * @var id
         * @var application branch_initiator_id bo'yicha role larni oladi
         *
         * foreach da shu role lardan
         * Permissionni Company_Performer va Branch_Performer bo'lganlarini ovotti
         */

        $id = DB::table('roles')->whereRaw('json_contains(branch_id, \'["' . $application->branch_initiator_id . '"]\')')->pluck('id')->toArray();

        foreach ($id as $role) {
            $role_company[] = PermissionRole::where('role_id', $role)->where('permission_id', ApplicationMagicNumber::Company_Performer)->get()->pluck('role_id');

            $role_company = array_diff($role_company, ['[]']);

            $branch = PermissionRole::where('role_id', $role)->where('permission_id', ApplicationMagicNumber::Branch_Performer)->get()->pluck('role_id');

            $role_branch[] = $branch;
            $role_branch = array_diff($role_branch, ['[]']);
        }
        $performers_company = $id ? Roles::find($role_company)->pluck('display_name', 'id') : [];
        $performers_branch = $id ? Roles::find($role_branch)->pluck('display_name', 'id') : [];
        $access_comment = Position::find($user->position_id);
        $subjects = Subject::all();
        $purchases = Purchase::all();
        $branch_name = Branch::find($application->user->branch_id, 'name');
        $branch = Branch::all()->pluck('name', 'id');

        $perms['CompanyLeader'] = $application->user_id !== $user->id && $user->hasPermission(PermissionEnum::Company_Leader) && $application->show_leader === ApplicationMagicNumber::one;
        $perms['BranchLeader'] = $application->user_id !== $user->id && $user->hasPermission(PermissionEnum::Branch_Leader) && $application->show_leader === ApplicationMagicNumber::one;
        $perms['PerformerComment'] = $application->performer_role_id === $user->role_id && $user->leader === ApplicationMagicNumber::zero;
        $perms['NumberChange'] = $user->hasPermission(PermissionEnum::Number_Change) && !$user->hasPermission(PermissionEnum::Plan_Budget) && !$user->hasPermission(PermissionEnum::Plan_Business);
        $perms['Plan'] = ($check && $user->hasPermission('Plan_Budget')) || ($user->hasPermission('Plan_Business') && $check);
        $perms['PerformerLeader'] = $application->performer_role_id === $user->role_id && $user->leader === ApplicationMagicNumber::one;
        $perms['Signers'] = ($access && $user->hasPermission(PermissionEnum::Company_Signer || PermissionEnum::Add_Company_Signer || PermissionEnum::Branch_Signer || PermissionEnum::Add_Branch_Signer || PermissionEnum::Company_Performer || PermissionEnum::Branch_Performer)) || ($access && $user->role_id === ApplicationMagicNumber::Director && $application->show_director === ApplicationMagicNumber::one);
        $status = $application->status;
        return ['performer_file' => $performer_file, 'perms' => $perms, 'access_comment' => $access_comment, 'performers_company' => $performers_company, 'performers_branch' => $performers_branch, 'file_basis' => $file_basis, 'file_tech_spec' => $file_tech_spec, 'other_files' => $other_files, 'user' => $user, 'application' => $application, 'branch' => $branch, 'signedDocs' => $signedDocs, 'same_role_user_ids' => $same_role_user_ids, 'access' => $access, 'subjects' => $subjects, 'purchases' => $purchases, 'branch_name' => $branch_name, 'check' => $check, 'status' => $status];
    }

    public function edit($application, $user)
    {
        $status_extented = StatusExtended::all()->pluck('name', 'id')->toArray();
        if ($user->id !== $application->user_id && !$user->hasPermission(PermissionEnum::Warehouse) && !$user->hasPermission(PermissionEnum::Company_Performer) && !$user->hasPermission(PermissionEnum::Branch_Performer)) {
            return redirect()->route('site.applications.index');
        }
        $countries = ['0' => 'Select country'];
        $countries[] = Country::get()->pluck('country_name', 'country_alpha3_code')->toArray();
        $select = Resource::pluck('name', 'id');
        $performer_file = json_decode($application->performer_file);
        $branch_signer = json_decode($application->branch->add_signers);
        $addsigner = Branch::find(ApplicationMagicNumber::Company);
        $company_signer = json_decode($addsigner->add_signers);
        return [
            'application' => $application,
            'purchase' => Purchase::all()->pluck('name', 'id'),
            'subject' => Subject::all()->pluck('name', 'id'),
            'branch' => Branch::all()->pluck('name', 'id'),
            'status_extented' => $status_extented,
            'countries' => $countries,
            'component' => $this->checkComponentsInclude($application, $user),
            'products' => $select,
            'warehouse' => Warehouse::where('application_id', $application->id)->first(),
            'performer_file' => $performer_file,
            'user' => $user,
            'company_signers' => $company_signer ? Roles::find($company_signer)->sortBy('index')->pluck('display_name', 'id')->toArray() : null,
            'branch_signers' => $branch_signer ? Roles::find($branch_signer)->sortBy('index')->pluck('display_name', 'id')->toArray() : null,
        ];
    }

    public function update($application, $request, $user)
    {
        $now = Carbon::now();
        $data = $request->validated();
        $data['with_nds'] = 0;
        $roles = ($application->branch_signers->signers);
        if (isset($data['signers'])) {
            $array = $roles ? array_merge(json_decode($roles), $data['signers']) : $data['signers'];
            $data['signers'] = json_encode($array);
            foreach ($array as $signers) {
                $signer = SignedDocs::where('application_id', $application->id)->where('role_id', $signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->role_index = Roles::find($signers)->index === null ? ApplicationMagicNumber::one : (Roles::find($signers)->index);
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer === null ? $docs->save() : [];
            }
            if ($application->signers !== null) {
                $signers = json_decode($data['signers']);
                $signedDocs = SignedDocs::where('application_id', $application->id)->pluck('role_id')->toArray();
                $not_signer = array_diff($signedDocs, $signers);
                foreach ($not_signer as $delete) {
                    SignedDocs::where('application_id', $application->id)->where('role_id', $delete)->delete();
                }
            }
            $message = "{$application->id} " . "{$application->name} " . setting('admin.application_created');
            $this->sendNotifications($array, $application, $message);
        } elseif ($application->signers === null) {
            $data['signers'] = $roles;
            $array = json_decode($roles);
            foreach ($array as $signers) {
                $signer = SignedDocs::where('application_id', $application->id)->where('role_id', $signers)->first();
                $docs = new SignedDocs();
                $docs->role_id = $signers;
                $docs->role_index = Roles::find($signers)->index;
                $docs->application_id = $application->id;
                $docs->table_name = "applications";
                $signer === null ? $docs->save() : [];
            }
            $message = "{$application->id} " . "{$application->name} " . setting('admin.application_created');
            $this->sendNotifications($array, $application, $message);
        }
        if ($application->signers !== null && !isset($data['signers'])) {
            $signers = json_decode($roles);
            $signedDocs = SignedDocs::where('application_id', $application->id)->pluck('role_id')->toArray();
            $not_signer = array_diff($signedDocs,$signers);
            $data['signers'] = $roles;
            foreach ($not_signer as $delete) {
                SignedDocs::where('application_id', $application->id)->where('role_id', $delete)->delete();
            }
        }
        if (isset($data['draft'])) {
            if ($data['draft'] == ApplicationMagicNumber::one)
                $data['status'] = ApplicationStatusEnum::Draft;
            else
                $data['status'] = ApplicationStatusEnum::New;
        }
        if (isset($data['performer_status'])) {
            $application->performer_user_id = $user->id;
            $application->status = ApplicationStatusEnum::Extended;
        }
        if (isset($data['performer_leader_comment'])) {
            $data['performer_leader_comment_date'] = $now->toDateTimeString();
            $data['performer_leader_user_id'] = $user->id;
        }
        if (isset($data['performer_comment'])) {
            $data['performer_comment_date'] = $now->toDateTimeString();
            $data['performer_user_id'] = $user->id;
        }
        if (isset($data['resource_id'])) {
            if ($data['resource_id'] === "[object Object]") {
                $data['resource_id'] = null;
            } else {
                $explode = explode(',', $data['resource_id']);
                $data['resource_id'] = json_encode($explode);
            }
        }

        if (isset($data['performer_role_id'])) {
            $data['performer_received_date'] = $now->toDateTimeString();
            $data['status'] = ApplicationStatusEnum::Distributed;
            $data['show_leader'] = ApplicationMagicNumber::two;
            $data['branch_leader_user_id'] = $user->id;
        }

        $result = $application->update($data);
        if ($result)
            return redirect()->route('site.applications.show', $application->id);

        return redirect()->back()->with('danger', trans('site.application_failed'));
    }

    public function is_more_than_limit($application, $request)
    {
        $application->is_more_than_limit = $request->is_more_than_limit;
        $application->signers = null;
        $branch_id = auth()->user()->branch_id;
        if ($request->is_more_than_limit == ApplicationMagicNumber::one) {
            $application->branch_initiator_id = ApplicationMagicNumber::Company;
        } else {
            $application->branch_initiator_id = $branch_id;
        }
        $application->branch_id = $branch_id;
        SignedDocs::where('application_id', $application->id)->delete();
        $application->save();
    }

    public function sendNotifications($array, $application, $message)
    {
        if ($array !== null) {
            if (is_resource(@fsockopen(env('LARAVEL_WEBSOCKETS_HOST', '127.0.0.1'), env('LARAVEL_WEBSOCKETS_PORT', 6001)))) {
                $websocket = true;
            } else {
                $websocket = false;
            }
            $user_ids = User::query()->whereIn('role_id', $array)->where('branch_id', $application->branch_initiator_id)->pluck('id')->toArray();
            foreach ($user_ids as $user_id) {
                $notification = Notification::query()->firstOrCreate(['user_id' => $user_id, 'application_id' => $application->id, 'message' => $message]);
                if ($notification->wasRecentlyCreated) {
                    $diff = now()->diffInMinutes($application->created_at);
                    $data = [
                        'id' => $application->id,
                        'time' => $diff === ApplicationMagicNumber::zero ? 'recently' : $diff
                    ];
                    if ($websocket) {
                        broadcast(new Notify(json_encode($data, $assoc = true), $user_id))->toOthers();     // notification
                    }
                }
            }
        }

    }

    public function to_sign_data($user)
    {
        $signedDocs = SignedDocs::where('role_id', $user->role_id)->where('status', null)->pluck('application_id')->toArray();
        $data = Application::find($signedDocs);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function ($docs) {
                return $docs->user_id ? $docs->user->name : "";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->format('d.m.Y') : '';
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at ? with(new Carbon($data->updated_at))->format('d.m.Y') : '';
            })
            ->editColumn('status', function ($query) {
                /*
                     *  Voyager admin paneldan status ranglarini olish va chiqarish
                     */

                $status = $query->status;
                $color = setting("color.{$status}");
                if ($query->performer_status !== null) {
                    $a = StatusExtended::find($query->performer_status);
                    $status = $a->name;
                    $color = $a->color;
                }
                return json_encode(['backgroundColor' => $color, 'app' => $this->translateStatus($status), 'color' => $color ? 'white' : 'black']);
            })
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $data = array();

                if (auth()->user()->id == $row->user_id || auth()->user()->hasPermission(PermissionEnum::Warehouse) || $row->performer_role_id == auth()->user()->role_id) {
                    $data['edit'] = route('site.applications.edit', $row->id);
                }

                $data['show'] = route('site.applications.show', $row->id);

                if ($row->user_id == auth()->user()->id) {
                    $data['destroy'] = route('site.applications.destroy', $row->id);
                }

                if (($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Canceled) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Refused) || ($row->user_id === auth()->user()->id && $row->status === ApplicationStatusEnum::Rejected)) {
                    $data['clone'] = route('site.applications.clone', $row->id);
                }
                return json_encode(['link' => $data]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    private function checkComponentsInclude($application, $user)
    {
        if ($application->user_id == $user->id && $application->show_leader != Application::NOT_DISTRIBUTED) {
            return "site.applications.form_edit";
        } elseif (($user->hasPermission('Branch_Performer') && $application->user_id != $user->id) ||
            ($user->hasPermission('Company_Performer') && $application->user_id != $user->id) ||
            ($application->performer_role_id == $user->role_id)) {
            return "site.applications.performer";
        } elseif (($user->hasPermission('Warehouse') && $application->status == ApplicationStatusEnum::Accepted) ||
            ($user->hasPermission('Warehouse') && $application->status == ApplicationStatusEnum::Order_Delivered) ||
            ($user->hasPermission('Warehouse') && $application->status == ApplicationStatusEnum::Order_Arrived)) {
            return "site.applications.warehouse";
        } else {
            Log::debug('В файле ApplicationService, метод checkComponentsInclude(стр.908)', [$application, $user]);
            abort(404);
        }
    }

    private function translateStatus($status)
    {
        switch ($status) {
            case 'new':
                return __('Новая');
                break;
            case "in_process":
                return __('На рассмотрении');
                break;
            case "overdue":
                return __('просрочен');
                break;
            case "refused":
                return __('Отказана');
                break;
            case "agreed":
                return __('Согласована');
                break;
            case "rejected":
                return __('Отклонена');
                break;
            case "distributed":
                return __('Распределен');
                break;
            case "canceled":
                return __('Отменен');
                break;
            default:
                return $status;
        }
    }
}
