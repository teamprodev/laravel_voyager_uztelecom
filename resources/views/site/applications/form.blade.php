<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Ташаббускор (буюртмачи номи )')
                        ->name('initiator')
                    }}
                    {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                        ->name('purchase_basis')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio','Сотиб олинадиган махсулот тавсифи (техник характери)')
                        ->name('specification')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio','Махсулот келишининг муддати')
                        ->name('delivery_date')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                        ->name('name')
                    }}
                    {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                        ->name('basis')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio','Алоҳида талаблар')
                        ->name('separate_requirements')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio','Махсулот сифати учун кафолат муддати (иш, хизмат)')
                        ->name('expire_warranty_date')
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Харид режаси (сумма)')
                        ->name('planned_price')
                        ->id('summa')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                        ->name('info_business_plan')
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Эквивалентная Планируемая сумма')
                        ->name('equal_planned_price')
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select([1 => 'товар', 2 => 'работа', 3 => 'услуга'], 'select', 'Предмет закупки')
                        ->value(1)
                        ->name('subject')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select([1 => 'тендер', 2 => 'отбор', 3 => 'Eshop'], 'select', 'Вид закупки')
                        ->value(1)
                        ->name('type_of_purchase_id')
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                        ->name('info_purchase_plan')
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio','Коментарий к заявке')
                        ->name('comment')
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    <h6><b>Филиални танланг</b></h6>
                    <select class="custom-select" name="filial_initiator_id" id="filial_initiator_id">
                        @foreach($branch as $branches)
                            <option value="{{$branches->id}}">{{$branches->name}}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="pt-2 pb-2 w-50">--}}
{{--                    <h6><b>Товар (хизмат) ишлаб чиқарилган мамлакат</b></h6>--}}
{{--                    <select class="col-md-6 custom-select" name="country_produced_id" id="country_produced_id">--}}
{{--                        @foreach($countries as $country)--}}
{{--                            <option value="{{$country->id}}">{{$country->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                {{Aire::select($countries, 'country_produced_id', 'Select')
                ->value('0')}}

            </div>
            </div>
        </div>
    {{Aire::select($roles, 'signers', 'Multi-Select')
                    ->multiple()
                    }}
    <div class="w-full text-right py-4 pr-10">
        <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
    </div>
</div>
