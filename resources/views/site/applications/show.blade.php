@extends('site.layouts.wrapper')

@section('center_content')


    <div class="mt-6">
        <div class="w-full flex">
            <div class="p-6">
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::input('bio','Ташаббускор (буюртмачи номи )')
                            ->name('initiator')
                            ->value($application->initiator)
                            ->disabled()
                        }}
                        {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                            ->name('purchase_basis')
                            ->value($application->purchase_basis)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                        {{Aire::textArea('bio','Сотиб олинадиган махсулот тавсифи (техник характери)')
                            ->name('specification')
                            ->value($application->specification)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                        {{Aire::input('bio','Махсулот келишининг муддати')
                            ->name('delivery_date')
                            ->value($application->delivery_date)
                            ->disabled()
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::input('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                            ->name('name')
                            ->value($application->name)
                            ->disabled()
                        }}
                        {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                            ->name('basis')
                            ->value($application->basis)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                        {{Aire::textArea('bio','Алоҳида талаблар')
                            ->name('separate_requirements')
                            ->value($application->separate_requirements)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                        {{Aire::input('bio','Махсулот келишининг муддати')
                            ->name('expire_warranty_date')
                            ->value($application->expire_warranty_date)
                            ->disabled()
                        }}
                    </div>
                </div>
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::input('bio','Харид режаси (сумма)')
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
                        {{Aire::select(['USD' => 'USD', 'UZS' => 'UZS'], 'select', 'Валюта')
                        ->name('currency')
                        ->value($application->currency)
                        ->id('valyuta')
                        ->disabled()
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::input('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                            ->name('info_business_plan')
                            ->value($application->info_business_plan)
                            ->disabled()
                        }}
                    </div>

                </div>
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::input('bio','Эквивалентная Планируемая сумма')
                            ->name('equal_planned_price')
                            ->value($application->equal_planned_price)
                            ->disabled()
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::input('bio','Наименование поставщика')
                            ->name('supplier_name')
                            ->value($application->supplier_name)
                            ->disabled()
                        }}
                    </div>
                </div>
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::select([1 => 'товар', 2 => 'работа', 3 => 'услуга'], 'select', 'Предмет закупки')
                            ->name('subject')
                            ->value($application->subject)
                            ->disabled()
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::select([1 => 'тендер', 2 => 'отбор', 3 => 'Eshop'], 'select', 'Вид закупки')
                            ->name('type_of_purchase_id')
                            ->value($application->type_of_purchase_id)
                            ->disabled()
                        }}
                    </div>
                </div>
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                            ->name('info_purchase_plan')
                            ->value($application->info_purchase_plan)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::textArea('bio','Коментарий к заявке')
                            ->name('comment')
                            ->value($application->comment)
                            ->rows(3)
                            ->cols(40)
                            ->disabled()
                        }}
                    </div>
                </div>
                <div class="flex items-baseline">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        <h6><b>Филиални танланг</b></h6>
                        <select class="custom-select" name="filial_initiator_id" id="filial_initiator_id">
                            <option value="{{$application->filial_initiator_id}}" selected
                                    disabled>{{$branch->name}}</option>
                        </select>
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        <h6><b>Товар (хизмат) ишлаб чиқарилган мамлакат</b></h6>
                        <select class="col-md-6 custom-select" name="country_produced_id" id="country_produced_id">
                            <option value="{{$application->country_produced_id}}" selected
                                    disabled>{{$application->country->country_name ?? "Unknown Country"}}</option>
                        </select>
                    </div>
                </div>
                @if($application->with_nds == 1)
                    {{Aire::checkbox('checkbox', 'QQS bilan')->name('with_nds')->checked()->disabled()}}
                @else
                    {{Aire::checkbox('checkbox', 'QQS bilan emas')->disabled()}}
                @endif
            </div>
        </div>
        {{--        @if(!$access)--}}

        {{--                @endif--}}
        @forelse($signedDocs as $sign)
            @php
                if(isset($data)) unset($data);
                $data = \Arr::get(json_decode($sign->data, true), 0);
            @endphp
            <div class="w-96 h-24 grid grid-flow-row-dense grid-cols-3 grid-rows-3 p-5 border-4 bg-white
            {{$sign->status == 1 ? "border-green-500" : "border-red-500"}}">
                @if($data)
                    <h6 class="{{$sign->status == 1 ? "text-green-500" : "text-red-500"}}
                            col-span-3">{{$data["name"]}}</h6>
                    <small class="col-span-1">{{ $sign["stir"]}}</small>
                @endif
            </div>
        @empty

        @endforelse
    <!-- Modal toggle -->
        @if(in_array(auth()->user()->role_id, json_decode($application->roles_need_sign, true)) &&
            !in_array(auth()->id(), $same_role_user_ids) && !(\App\Models\SignedDocs::where('application_id',
            $application->id)->where('user_id', auth()->id())->first()))
            <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" data-modal-toggle="defaultModal">
                Imzolash
            </button>

            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                Please comment
                            </h3>
                            <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="defaultModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form name="testform" id="sign_form" action="{{route('site.applications.imzo.sign',
                            ['application' => $application->id])}}"
                                  method="POST">
                                @csrf
                                <label id="message"></label>
                                <div class="form-group">
                                    <label for="select1">Выберите ключ</label>
                                    <select name="key" id="select1" onchange="cbChanged(this)"></select><br/>
                                </div>
                                <div class="form-group hidden">
                                    <label for="exampleFormControlTextarea1">Текст для подписи</label>
                                    <textarea class="form-control" id="eri_data" name="data"
                                              rows="3">"Applications_".{{$application->id}}</textarea>
                                </div>
                                {{Aire::textArea('bio','Коментария')
                                    ->name('comment')
                                    ->rows(3)
                                    ->cols(40)
                                }}
                                <label hidden id="keyId"></label><br/>
                                <div class="form-group hidden">
                                    <label for="exampleFormControlTextarea3">Подписанный документ PKCS#7</label>
                                    <textarea class="form-control" readonly required name="pkcs7"
                                              id="exampleFormControlTextarea3"
                                              rows="3"></textarea>
                                </div>
                                <br/>
                                <input id="status" name="status" class="hidden" type="text">
                                <input value="applications" id="table_name" name="table_name" class="hidden"
                                       type="text">
                                <input value="{{$application->id}}" id="column_id" name="column_id" class="hidden"
                                       type="text">
                                <div class="row ml-4">

                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button onclick="accept()" type="submit" class="btn btn-success col-md-2">Accept</button>
                            <button onclick="reject()" type="submit" class="btn btn-danger col-md-2">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        function accept() {
            document.getElementById('status').value = 1;
            sign();

        }

        function reject() {
            document.getElementById('status').value = 0;
            sign();
        }

        function functionBack() {
            window.history.back();
        }
    </script>

@endsection
<script src="{{asset("assets/js/eimzo/e-imzo.js")}}"></script>
<script src="{{asset("assets/js/eimzo/e-imzo-client.js")}}"></script>
<script src="{{asset("assets/js/eimzo/eimzo.js")}}"></script>
