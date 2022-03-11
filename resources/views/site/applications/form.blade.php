<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
                            {{Aire::textArea('bio','Ташаббускор (буюртмачи номи )')
                                ->name('initiator')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                                ->name('purchase_basis')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                                ->name('basis')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                                ->name('name')
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
                            {{Aire::textArea('bio','Алоҳида талаблар')
                                ->name('separate_requirements')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Махсулотга қўйилган бошқа талаблар (иш, хизмат)')
                                ->name('other_requirements')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::dateTimeLocal('bio','Махсулот сифати учун кафолат муддати (иш, хизмат)')
                                ->name('expire_warranty_date')
                            }}
                            {{Aire::textArea('bio','Харид режаси (сумма)')
                                ->name('amount')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)')
                                ->name('incoterms')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                                ->name('budget_planning')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                                ->name('procurement_plan')
                                ->rows(3)
                                ->cols(40)
                            }}
                            {{Aire::textArea('bio','Коментарий к заявке')
                                ->name('comment')
                                ->rows(3)
                                ->cols(40)
                            }}
                <select class="custom-select" name="filial_initiator_id" id="filial_initiator_id">
                    @foreach($branch as $branches)
                    <option value="{{$branches->id}}">{{$branches->name}}</option>
                    @endforeach
                </select>

        </div>
        </div>
    </div>
    {{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
    <div class="w-full text-right py-4 pr-10">
        <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
        <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
    </div>
</div>
