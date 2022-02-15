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
                            <input required type="text" id="name" name="initiator" placeholder="nomi" class="h-16 p-2
                            border
                            focus:outline-none w-full">
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <textarea class="resize-none py-4 focus:outline-none h-16 border w-full" name="" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <textarea class="resize-none py-4 h-16 focus:outline-none border w-full" name="basis" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <textarea class="resize-none py-4 h-16 focus:outline-none border w-full" name="name" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот тавсифи (техник характери)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" name="specification" class="focus:outline-none  h-16 border w-full">
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот келишининг муддати
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" name="delivery_date" class="focus:outline-none h-16 border w-full">
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Алоҳида талаблар
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотга қўйилган бошқа талаблар (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот сифати учун кафолат муддати (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" name="expire_warranty_date" class="focus:outline-none border h-16 w-full" value="">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид режаси (сумма)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input id="amount" name="amount" type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <input type="text" name="incoterms" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-semibold">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    </tbody>
                </table>
        </div>



        <div class="xl:w-4/12 md:w-2/12 px-4">
            @auth
            <div class="w-full">
                <div class="relative z-10">
                    <img src="https://www.csircmc.res.in/sites/default/files/default_images/default_man_photo.jpg"
                         alt=""
                        class="w-28 mx-auto rounded-full">
                </div>
                <div class="shadow-xl rounded-xl bg-gray-100 relative pt-20 -top-16 pb-6">
                    <div class="border-b border-gray-300 mx-6 p-2">
                        <span class="text-xs text-gray-500">Ф.И.О:</span><br>
                        {{$user->name}}
                    </div>
                    <div class="border-b border-gray-300 mx-6 p-2">
                        <span class="text-xs text-gray-500">Тел номер:</span><br>
                        {{$user->phone}}
                    </div>
                    <div class="border-b border-gray-300 mx-6 p-2">
                        <span class="text-xs text-gray-500">Отдел (управление):</span><br>
                        {{$user->department->name}}
                    </div>
                    <div class="border-b border-gray-300 mx-6 p-2">
                        <span class="text-xs text-gray-500">Должность:</span><br>
                        {{$user->role->name}}
                    </div>
                </div>
            </div>
            @endauth
            <h5 class="text-center font-semibold pb-5 text-lg">Прикрепить файл</h5>
            <div class="w-full xl:flex">
                <div class="p-2 xl:w-1/2 mt-2 text-center bg-blue-500 hover:bg-blue-700 transition border">
                    <label class="p-2 text-center text-white text-xs cursor-pointer">
                        <input type="file" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i> Основание
                    </label>
                </div>
                <div class="p-2 xl:w-1/2 mt-2 bg-green-500 text-center hover:bg-green-700 transition border">
                    <label class=" p-2   text-xs cursor-pointer text-white">
                        <input type="file" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i> Техническое задание
                    </label>
                </div>
            </div>
            <div class="w-full">
                <div class="w-full my-1 border text-white p-2 text-center text-xs bg-red-500 hover:bg-red-700 transition cursor-pointer">
                    <label class="">
                        <input type="file" class="hidden"/>
                        <i class="fa fa-cloud-upload"></i> Другие документы необходимые для запуска закупочной процедуры
                    </label>
                </div>
            </div>
            <div class="w-full mt-4 px-2">
                <div class="w-full">
                    <div class="">
                        <label for="exampleFormControlTextarea1">Коментарий к заявке</label>
                        <textarea class="resize-none focus:outline-none border w-full" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full text-right py-4 pr-10">
        <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
        <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
    </div>
</div>


