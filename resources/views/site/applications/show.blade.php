@extends('site.layouts.wrapper')

@section('center_content')


    <div class="mt-6">
        <div class="w-full text-right py-4 pr-10">
            <button class="btn btn-danger" onclick="functionBack()">Назад</button>
        </div>
        <div class="w-full flex">
            <div class="p-6">
                {{Aire::textArea('bio','Ташаббускор (буюртмачи номи )')
                    ->name('initiator')
                    ->value($application->initiator)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                    ->name('purchase_basis')
                    ->value($application->purchase_basis)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                    ->name('basis')
                    ->value($application->basis)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                    ->name('name')
                    ->value($application->name)
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
                    ->disabled()
                    ->value($application->delivery_date)
                }}
                {{Aire::textArea('bio','Алоҳида талаблар')
                    ->name('separate_requirements')
                    ->value($application->separate_requirements)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Махсулотга қўйилган бошқа талаблар (иш, хизмат)')
                    ->name('other_requirements')
                    ->value($application->other_requirements)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::input('bio','Махсулот сифати учун кафолат муддати (иш, хизмат)')
                    ->name('expire_warranty_date')
                    ->disabled()
                    ->value($application->expire_warranty_date)
                }}
                {{Aire::textArea('bio','Харид режаси (сумма)')
                    ->name('amount')
                    ->value($application->amount)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)')
                    ->name('incoterms')
                    ->value($application->incoterms)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                    ->name('budget_planning')
                    ->value($application->budget_planning)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                    ->name('procurement_plan')
                    ->value($application->procurement_plan)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                {{Aire::textArea('bio','Коментарий к заявке')
                    ->name('comment')
                    ->value($application->comment)
                    ->rows(3)
                    ->cols(40)
                    ->disabled()
                }}
                <form name="testform" action="{{route('site.applications.imzo.sign')}}" method="POST">
                    @csrf
                    <label id="message"></label>
                    <div class="form-group">
                        <label for="select1">Выберите ключ</label>
                        <select name="key" id="select1" onchange="cbChanged(this)"></select><br />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Текст для подписи</label>
                        <textarea class="form-control" id="eri_data" name="data" rows="3"></textarea>
                    </div>
                    ID ключа <label id="keyId"></label><br />

                    <button onclick="sign()" class="btn btn-success" type="button">GENERATE KEY</button><br />


                    <div class="form-group">
                        <label for="exampleFormControlTextarea3">Подписанный документ PKCS#7</label>
                        <textarea class="form-control" readonly required name="pkcs7" id="exampleFormControlTextarea3"
                                  rows="3"></textarea>
                    </div><br />
                    <div class="row ml-4">
                        <button type="submit" class="btn btn-success col-md-2" >Sign</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        function functionBack()
        {
            window.history.back();
        }
    </script>

@endsection
    <script src="{{asset("assets/js/eimzo/e-imzo.js")}}"></script>
    <script src="{{asset("assets/js/eimzo/e-imzo-client.js")}}"></script>
    <script src="{{asset("assets/js/eimzo/eimzo.js")}}"></script>
