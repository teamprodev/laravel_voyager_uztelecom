<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
                <table class="table-auto">
                    <tbody>
                    <tr class="h-16">
                        <td class="xl:w-3/6 md:w-4/6 border p-2 font-semibold">
                            Ташаббускор (буюртмачи номи )
                        </td>

                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('initiator')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('purchase_basis')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('basis')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('name')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот тавсифи (техник характери)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('specification')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот келишининг муддати
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::dateTimeLocal()
                                ->name('delivery_date')
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                                Алоҳида талаблар
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('separate_requirements')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотга қўйилган бошқа талаблар (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('other_requirements')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот сифати учун кафолат муддати (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::dateTimeLocal()
                                ->name('expire_warranty_date')
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид режаси (сумма)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('amount')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('incoterms')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('budget_planning')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            {{Aire::textArea()
                                ->name('procurement_plan')
                                ->rows(3)
                                ->cols(40)
                            }}
                        </td>
                    </tr>
                    </tbody>
                </table>
        </div>



        <div class="xl:w-4/12 md:w-2/12 px-4">
            @auth
                @include('site.profile.profile_component')
            @endauth
            <h5 class="text-center font-semibold pb-5 text-lg">Прикрепить файл</h5>
            <div class="w-full xl:flex">
                <div class="p-2 xl:w-1/2 mt-2 text-center bg-blue-500 hover:bg-blue-700 transition border">
                    <label class="">
                        <input type="file" name="file_basis" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i>Основание
                    </label>
                </div>
                <div class="p-2 xl:w-1/2 mt-2 bg-green-500 text-center hover:bg-green-700 transition border">
                    <label class="">
                        <input type="file" name="file_tech_spec" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i> Техническое задание
                    </label>
                </div>
            </div>
            <div class="w-full">
                <div class="w-full my-1 border text-white p-2 text-center text-xs bg-red-500 hover:bg-red-700 transition cursor-pointer">
                    <label class="">
                        <input type="file" name="other_files" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i> Другие документы необходимые для запуска закупочной процедуры
                    </label>
                </div>
            </div>
            <div class="w-full mt-4 px-2">
                <div class="w-full">
                    <div class="">
                        <label for="exampleFormControlTextarea1">Коментарий к заявке</label>
{{--                        <textarea class="resize-none focus:outline-none border w-full" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                        {{Aire::textArea()
                                ->name('comment')
                                    ->rows(3)
                                    ->cols(40)
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
    <div class="w-full text-right py-4 pr-10">
        <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
        <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
    </div>
</div>


