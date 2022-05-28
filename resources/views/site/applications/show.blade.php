@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <a href="{{route('site.applications.edit',$application->id)}}" class="btn btn-success">Изменить</a>
    </div>
    <div class="px-6 pb-0 pt-6">
        <h5><strong>{{ __('lang.author') }}</strong> {{$application->user->name}} ( {{ $application->user->role->display_name }} )</h5>
        <h5><strong>{{ __('lang.author_filial') }}</strong> {{ $branch_name->name }}</h5>
        <h5><strong>{{ __('lang.number') }} : </strong> {{$application->number}} </h5>
        <h5><strong>Date : </strong> {{$application->date}} </h5> <br>
        <h5><strong>Визирование заявки через : </strong>
            @if($application->is_more_than_limit == 1)
                Компанию
            @else
                Филиала
            @endif
        </h5> <br>
    </div>
    <div class="flex items-baseline">
        <div class="pt-2 w-100">
            <div class="flex items-baseline">
                <div class="p-6">
                    <div class="mb-3 row">
                        <label class="col-sm-6" for="initiator" class="col-sm-2 col-form-label">{{ __('lang.table_1') }}</label>
                        <div class="col-sm-6">
                            {{Aire::input()
                                ->name("initiator")
                                ->value($application->initiator)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="purchase_basis" class="col-sm-2 col-form-label">{{ __('lang.table_9') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("purchase_basis")
                                ->value($application->purchase_basis)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="basis" class="col-sm-2 col-form-label">{{ __('lang.table_11') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("basis")
                                ->value($application->basis)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="name" class="col-sm-2 col-form-label">{{ __('lang.table_2') }}</label>
                        <div class="col-sm-6">
                            {{Aire::input()
                                ->name("name")
                                ->value($application->name)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="specification" class="col-sm-2 col-form-label">{{ __('lang.table_10') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("specification")
                                ->value($application->specification)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row w-50">
                        <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">{{ __('lang.table_3') }}</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="date" name="delivery_date" value="{{ $application->delivery_date }}" type="date"/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="separate_requirements" class="col-sm-2 col-form-label">{{ __('lang.table_12') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("separate_requirements")
                                ->value($application->separate_requirements)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="other_requirements" class="col-sm-2 col-form-label">{{ __('lang.other') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("other_requirements")
                                ->value($application->other_requirements)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row w-50">
                        <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">{{ __('lang.table_14') }}</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="date" name="expire_warranty_date" value="{{$application->expire_warranty_date}}" type="date"/>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="planned_price" class="col-sm-2 col-form-label">{{ __('lang.table_4') }}</label>
                        <div class="col-sm-6">
                            {{Aire::input()
                                ->name("planned_price")
                                ->id("planned_price")
                                ->value($application->planned_price)
                                ->class("form-control")->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="incoterms" class="col-sm-2 col-form-label">{{ __('lang.table_5') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("incoterms")
                                ->value($application->incoterms)
                                ->cols(40)
                                ->class("form-control")->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="info_purchase_plan" class="col-sm-2 col-form-label">{{ __('lang.table_20') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("info_purchase_plan")
                                ->value($application->info_purchase_plan)
                                ->cols(40)
                                ->class("form-control")->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="info_business_plan" class="col-sm-2 col-form-label">{{ __('lang.table_15') }}</label>
                        <div class="col-sm-6">
                            {{Aire::input()
                                ->name("info_business_plan")
                                ->value($application->info_business_plan)
                                ->class("form-control")->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-6" for="comment" class="col-sm-2 col-form-label">{{ __('lang.table_23') }}</label>
                        <div class="col-sm-6">
                            {{Aire::textArea()
                                ->rows(3)
                                ->name("comment")
                                ->value($application->comment)
                                ->cols(40)
                                ->class("form-control")
                                ->disabled()
                            }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="currency" class="col-sm-6 col-form-label">{{ __('lang.valyuta') }}</label>
                        <select class="form-control col-sm-6" name="currency" id="currency">
                            <option value="UZS" @if($application->currency === "UZS") selected @endif>UZS</option>
                            <option value="USD" @if($application->currency === "USD") selected @endif>USD</option>
                        </select>
                    </div>

                    <div class="mb-3 row">
                        <label for="currency" class="col-sm-6 col-form-label">{{ __('lang.branch') }}</label>
                        <select class="custom-select col-sm-6" name="branch_initiator_id" id="branch_initiator_id">
                            @isset($application->branch_initiator_id)
                                <option value="{{$application->branch_initiator_id}}"
                                        selected>{{$application->branch->name}}</option>
                            @endisset
                        </select>
                    </div>

                    @if(isset($application->resource_id))
                        <b>{{ __('lang.resource')}}</b>:
                        @foreach(json_decode($application->resource_id) as $product)
                            <br> {{\App\Models\Resource::find($product)->name}}
                        @endforeach
                    @endif

                    @if(isset($application->branch_leader_comment))
                        @php
                            $comment = \App\Models\User::find($application->branch_leader_user_id)->name;
                        @endphp
                        {{Aire::textArea('bio', __('lang.comment_suz') . ": {$comment}")
                        ->value($application->branch_leader_comment)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                         }}
                    @endif
                    @if(isset($application->performer_leader_comment))
                                @php
                                    $comment = \App\Models\User::find($application->performer_leader_user_id)->name;
                                @endphp
                                {{Aire::textArea('bio', __('lang.comment_per') . ": {$comment}")
                                    ->value($application->performer_leader_comment)
                                    ->rows(3)
                                    ->cols(40)
                                    ->disabled()
                                }}
                            @endif
                            @if(isset($application->performer_comment))
                                @php
                                    $comment = \App\Models\User::find($application->performer_user_id)->name;
                                @endphp
                                {{Aire::textArea('bio', __('lang.comment_p') . ": {$comment}")
                                    ->value($application->performer_comment)
                                    ->rows(3)
                                    ->cols(40)
                                    ->disabled()
                                }}
                            @endif
                            @if(isset($application->performer_role_id))
                                {{Aire::textArea('bio', __('lang.performer'))
                                    ->value(\App\Models\Roles::find($application->performer_role_id)->display_name)
                                    ->rows(3)
                                    ->cols(40)
                                    ->disabled()
                                }}
                            @endif
                    </div>
                    </div>
                </div>
                <div class="flex-direction: column">
                    @if($file_basis != 'null' && $file_basis != null)
                        <div class="my-5">
                            <h5 class="text-left">{{ __('lang.base') }}</h5>
                            @foreach($file_basis as $file)
                                @if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg'))
                                    <img src="/storage/uploads/{{$file}}" width="500" height="500" alt="not found">
                                @else
                                    <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/{{$file}}">{{preg_replace('/[0-9]+_/', '', $file)}}</a></button>
                                    <p class="my-2">{{preg_replace('/[0-9]+_/', '', $file)}}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if($file_tech_spec != 'null' && $file_tech_spec != null)
                        <div class="mb-5">
                            <h5 class="text-left">{{ __('lang.tz') }}</h5>
                            @foreach($file_tech_spec as $file)
                                @if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg'))
                                    <img src="/storage/uploads/{{$file}}" width="500" height="500" alt="not found">
                                @else
                                    <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/{{$file}}">{{preg_replace('/[0-9]+_/', '', $file)}}</a></button>
                                    <p class="my-2">{{preg_replace('/[0-9]+_/', '', $file)}}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if($other_files != 'null' && $other_files != null)
                        <div class="mb-5" style="width: 80%">
                            <h5 class="text-left">{{ __('lang.doc') }}</h5>
                            @foreach($other_files as $file)
                                @if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg'))
                                    <img src="/storage/uploads/{{$file}}" width="500" height="500" alt="not found">
                                @else
                                    <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/{{$file}}">{{preg_replace('/[0-9]+_/', '', $file)}}</a></button>
                                    <p class="my-2">{{preg_replace('/[0-9]+_/', '', $file)}}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="px-6">
                <table id="yajra-datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('lang.table_7') }}</th>
                        <th>{{ __('lang.table_22') }}</th>
                        <th>{{ __('lang.table_23') }}</th>
                        <th>{{ __('lang.table_24') }}</th>
                        <th>Дата подписи</th>
                    </tr>
                </thead>
            </table>
        </div>

        <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('site.applications.list.signedocs',$application->id) }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'status', name: 'status'},
                        {data: 'role_id', name: 'role_id'},
                        {data: 'comment', name: 'comment'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'updated_at', name: 'updated_at'},
                    ]
                });
            })
            </script>
            <div style="height: 50px"></div>
    {{ Aire::open()
    ->route('site.applications.update',$application->id)
    ->enctype("multipart/form-data")
    ->post() }}
            @if($user->hasPermission('Plan_Budget') || $user->hasPermission('Plan_Business'))
                {{Aire::textArea('bio', __('lang.table_20'))
                    ->name('info_purchase_plan')
                    ->value($application->info_purchase_plan)
                    ->rows(3)
                    ->cols(40)
                }}
                {{Aire::textArea('bio', __('lang.table_15'))
                    ->name('info_business_plan')
                    ->value($application->info_business_plan)
                    ->rows(3)
                    ->cols(40)
                }}

                @if($user->hasPermission('Number_Change'))
                    {{Aire::textArea('bio', __('lang.number'))
                        ->name('number')
                    }}
                    <div class="mb-3 row w-50">
                        <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">
                            {{__('lang.date')}}
                        </label>
                        <input class="form-control" id="date" name="date" type="date" value="{{$application->date}}"/>
                    </div>
                @endif
                {{Aire::submit('Save')}}

            @elseif($user->hasPermission('Number_Change') && !$user->hasPermission('Plan_Budget') && !$user->hasPermission('Plan_Business'))
                {{Aire::textArea('bio', __('lang.number'))
                    ->name('number')
                }}
                <div class="mb-3 row w-50">
                    <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">
                    {{__('lang.date')}}
                    </label>
                    <div class="col-sm-6">
                        <input class="form-control" id="date" name="date" type="date" value="{{$application->date}}"/>
                    </div>
                </div>
                {{Aire::submit('Save')}}
            @endif
            @if($application->is_more_than_limit = 1 && auth()->user()->hasPermission('Company_Leader') && $application->status == 'agreed')
                @if(!isset($application->performer_user_id))
                    <div class="pb-5">
                        <input type="text" class="hidden" value="{{auth()->user()->id}}" name="branch_leader_user_id">
                        {{Aire::textArea('bio', __('lang.comment_suz'))
                                ->name('branch_leader_comment')
                                ->rows(3)
                                ->cols(40)
                                 }}
                        <select class="col-md-6 custom-select" name="performer_role_id" id="performer_role_id">
                            @foreach($performers_company as $performer)
                                <option value="{{$performer->id}}">{{$performer->display_name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success col-md-2" >{{ __('lang.send') }}</button>
                    </div>
                @endif
            @elseif($application->is_more_than_limit = 0 && auth()->user()->hasPermission('Branch_Leader') && $application->status == 'accepted')
                @if(!isset($application->performer_user_id))
                    <div class="pb-5">
                        <input type="text" class="hidden" value="{{auth()->user()->id}}" name="branch_leader_user_id">
                        {{Aire::textArea('bio', __('lang.comment_suz'))
                                ->name('branch_leader_comment')
                                ->rows(3)
                                ->cols(40)
                                 }}
                        <select class="col-md-6 custom-select" name="performer_role_id" id="performer_role_id">
                            @foreach($performers_branch as $performer)
                                <option value="{{$performer->id}}">{{$performer->display_name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success col-md-2" >{{ __('lang.send') }}</button>
                    </div>
                @endif
            @elseif($application->performer_role_id == $user->role_id && $user->leader == 1)
                {{Aire::textArea('bio', __('lang.comment_per'))
                    ->name('performer_leader_comment')
                    ->value($application->performer_leader_comment)
                    ->rows(3)
                    ->cols(40)
                 }}
                <input  class="hidden"
                        name="performer_leader_user_id"
                        value="{{auth()->user()->id}}"
                        type="text">
                <div class="mt-4">
                    <button type="submit" class="btn btn-success col-md-2" >{{ __('lang.send') }}</button>
                </div>
            @elseif($application->performer_role_id == $user->role_id && $user->leader == 0)
                {{Aire::textArea('bio', __('lang.table_23'))
                    ->name('performer_comment')
                    ->value($application->performer_comment)
                    ->rows(3)
                    ->cols(40)
                 }}
                <input  class="hidden"
                        name="performer_user_id"
                        value="{{auth()->user()->id}}"
                        type="text">
                <div class="mt-4">
                    <button type="submit" class="btn btn-success col-md-2" >{{ __('lang.send') }}</button>
                </div>
            @endif
    {{Aire::close()}}
    @if($access && $user->hasPermission('Company_Signer'||'Add_Company_Signer'||'Branch_Signer'||'Add_Branch_Signer'||'Company_Performer'||'Branch_Performer') || $access && $user->role_id == 7 && $application->status == 'accepted')
        <div class="px-6">
            <form name="testform" action="{{route('site.applications.imzo.sign',$application->id)}}"        method="POST">
                @csrf
                <label id="message"></label>
                <div class="form-group">
                    <label for="select1">
                        {{ __('lang.eimzo_key') }}
                    </label>
                    <select name="key" id="select1" onchange="cbChanged(this)"></select> <br />
                </div>
                <div class="form-group hidden">
                    <label for="exampleFormControlTextarea1">
                        {{ __('lang.eimzo_title') }}
                    </label>
                    <textarea class="form-control" id="eri_data" name="data" rows="3"></textarea>
                </div>
                <div class="mb-2 text-center mr-6">
                    {{ __('lang.eimzo_id') }} <label id="keyId"></label><br />

                    <button onclick="generatekey()" class="hidden btn btn-success" type="button">{{ __('lang.eimzo_sign') }}</button><br />
                </div>
                <div class="w-1/2">
                    {{Aire::textArea('bio', __('lang.table_23'))
                    ->name('comment')
                    ->rows(3)
                    ->cols(40)
                     }}
                </div>
                <div class="form-group hidden">
                    <label for="exampleFormControlTextarea3">
                        Подписанный документ PKCS#7
                    </label>
                    <textarea   class="form-control" readonly required
                                name="pkcs7" id="exampleFormControlTextarea3"
                                rows="3"></textarea>
                </div> <br />
                <input id="status" name="status" class="hidden" type="text">
                <input value="applications" id="table_name" name="table_name" class="hidden" type="text">
                <input value="{{$application->id}}" id="application_id" name="application_id" class="hidden" type="text">
                <input value="{{auth()->user()->id}}" name="user_id" class="hidden" type="text">
                <input value="{{auth()->user()->role_id}}" name="role_id" class="hidden" type="text">
                <div class="row ml-4 pb-4">
                    <button onclick="status1()" type="submit" class="btn btn-success col-md-2" >
                        {{ __('lang.accept') }}
                    </button>
                    <button onclick="status0()" type="submit" class="btn btn-danger col-md-2 mx-2   " >
                        {{ __('lang.reject') }}
                    </button>
                </div>
            </form>
        </div>
    @endif
    <script>
        function generatekey()
        {
            var data = "application_{{$application->id}}";
            document.getElementById('eri_data').value = data;
            console.log(data);
            sign();
        }
        function status1()
        {
            document.getElementById('status').value = 1;
        }
        function status0()
        {
            document.getElementById('status').value = 0;
        }
        function functionBack()
        {
            window.history.back();
        }
    </script>
    <script src="{{asset("assets/js/eimzo/e-imzo.js")}}"></script>
    <script src="{{asset("assets/js/eimzo/e-imzo-client.js")}}"></script>
    <script src="{{asset("assets/js/eimzo/eimzo.js")}}"></script>
@endsection

