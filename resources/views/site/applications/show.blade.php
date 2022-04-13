@extends('site.layouts.app')

@section('center_content')


    <div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <h5>{{ __('lang.author') }} {{$application->user->name}}</h5>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_1'))
                        ->name('initiator')
                        ->value($application->initiator)
                        ->disabled()
                    }}
                    {{Aire::textArea('bio', __('lang.table_9'))
                        ->name('purchase_basis')
                        ->value($application->purchase_basis)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    {{Aire::textArea('bio', __('lang.table_10'))
                        ->name('specification')
                        ->value($application->specification)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    {{Aire::input('bio', __('lang.table_13'))
                        ->name('delivery_date')
                        ->value($application->delivery_date)
                        ->disabled()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_2'))
                        ->name('name')
                        ->value($application->name)
                        ->disabled()
                    }}
                    {{Aire::textArea('bio', __('lang.table_11'))
                        ->name('basis')
                        ->value($application->basis)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    {{Aire::textArea('bio', __('lang.table_12'))
                        ->name('separate_requirements')
                        ->value($application->separate_requirements)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    {{Aire::input('bio', __('lang.table_14'))
                        ->name('expire_warranty_date')
                        ->value($application->expire_warranty_date)
                        ->disabled()
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_4'))
                        ->name('planned_price')
                        ->value($application->planned_price)
                        ->id('summa')
                        ->disabled()
                    }}
                    {{Aire::input()
                        ->name('more_than_limit')
                        ->value($application->more_than_limit)
                        ->value('false')
                        ->class('hidden')
                        ->disabled()
                    }}
                    {{Aire::select(['USD' => 'USD', 'UZS' => 'UZS'], 'select', __('lang.valyuta'))
                    ->name('currency')
                    ->value($application->currency)
                    ->id('valyuta')
                    ->disabled()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_15'))
                        ->name('info_business_plan')
                        ->value($application->info_business_plan)
                        ->disabled()
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_16'))
                        ->name('equal_planned_price')
                        ->value($application->equal_planned_price)
                        ->disabled()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_17'))
                        ->name('supplier_name')
                        ->value($application->supplier_name)
                        ->disabled()
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($application->subject, 'select', __('lang.table_18'))
                        ->name('subject')
                        ->disabled()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($application->type_of_purchase_id, 'select', __('lang.table_19'))
                        ->name('type_of_purchase_id')
                        ->disabled()
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_20'))
                        ->name('info_purchase_plan')
                        ->value($application->info_purchase_plan)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_21'))
                        ->name('comment')
                        ->value($application->comment)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    @if(isset($application->performer_leader_comment))
                        @php
                            $comment = \App\Models\User::find($application->performer_leader_user_id)->name;
                        @endphp
                        {{Aire::textArea('bio', "Comment: {$comment}")
                            ->value($application->performer_leader_comment)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                    @endif
                </div>
            </div>
            </div>
        </div>
        @if($file_basis != 'null' && $file_basis != null)
        <div>
            @if(Str::contains($file_basis,'xlsx'||'pdf'||'docx'))
                <h1 class="text-center">{{ __('lang.base') }}</h1>
            @foreach($file_basis as $file)
                    <a href="/storage/{{$file}}" width="500" height="500" alt="not found">Get File</a>
                @endforeach
            @else
                @foreach($file_basis as $file)
                    <img src="/storage/{{$file}}" width="500" height="500" alt="not found">
                @endforeach
            @endif
        </div>
        @endif
        @if($file_tech_spec != 'null' && $file_tech_spec != null)
        <div>
            <h1 class="text-center">{{ __('lang.tz') }}</h1>
        @foreach($file_tech_spec as $file)
            @if(\Illuminate\Support\Str::contains($file,'xlsx')||\Illuminate\Support\Str::contains($file,'docx')||\Illuminate\Support\Str::contains($file,'pdf'))
                    <a href="/storage/{{$file}}">Get File</a>
            @else
                    <img src="/storage/{{$file}}" width="500" height="500" alt="not found">
                @endif
            @endforeach
        </div>
        @endif
        @if($other_files != 'null' && $other_files != null)
        <div>
            <h1 class="text-center">{{ __('lang.doc') }}</h1>
            @foreach($other_files as $file)
                <img src="/storage/{{$file}}" width="500" height="500" alt="not found">
            @endforeach
        </div>
        @endif
        <div class="px-6">
            <table id="yajra-datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('lang.table_7') }}</th>
                        <th>{{ __('lang.table_22') }}</th>
                        <th>{{ __('lang.table_23') }}</th>
                        <th>{{ __('lang.table_24') }}</th>
                    </tr>
                </thead>
            </table>
        </div>

        <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('site.applications.list.signedocs') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'status', name: 'status'},
                        {data: 'role_id', name: 'role_id'},
                        {data: 'comment', name: 'comment'},
                        {data: 'user_id', name: 'user_id'},
                    ]
                });
            });
            console.log("{{$application->id}}");
        </script>
        <div style="height: 50px"></div>
        @if(auth()->user()->hasPermission('Company_Leader') && $application->status == 'agreed')
            @if(!isset($application->performer_user_id))
                {{ Aire::open()
                    ->route('site.applications.update',$application->id)
                    ->enctype("multipart/form-data")
                    ->post()
                }}

                <select class="col-md-6 custom-select" name="performer_role_id" id="performer_role_id">
                    @foreach($performers_company as $performer)
                        <option value="{{$performer->id}}">{{$performer->display_name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success col-md-2" >Отправить</button>
                {{ Aire::close() }}
            @endif
        @elseif(auth()->user()->hasPermission('Branch_Leader'))
            @if(!isset($application->performer_user_id))
                {{ Aire::open()
                    ->route('site.applications.update',$application->id)
                    ->enctype("multipart/form-data")
                    ->post()
                }}
                <select class="col-md-6 custom-select" name="performer_role_id" id="performer_role_id">
                    @foreach($performers_branch as $performer)
                        <option value="{{$performer->id}}">{{$performer->display_name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success col-md-2" >Отправить</button>
                {{ Aire::close() }}
            @endif
        @elseif($application->performer_role_id == $user->role_id && $access_comment->leader == 1)
            {{ Aire::open()
                ->route('site.applications.update',$application->id)
                ->enctype("multipart/form-data")
                ->post()
            }}
            {{Aire::textArea('bio', __('lang.table_23'))
                ->name('performer_leader_comment')
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
            {{ Aire::close() }}
        @elseif($access && $user->hasPermission('Company_Signer'||'Add_Company_Signer'||'Branch_Signer'||'Add_Branch_Signer'||'Company_Performer'||'Branch_Performer') || $access && $user->role_id == 7)
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

