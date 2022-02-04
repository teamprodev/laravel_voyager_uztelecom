
    <div class="w-11/12 mx-auto shadow-md mt-6">
        <div class="w-full flex">
            <div class="w-8/12">
                <table class="table-auto">
                    <tbody>
                    <tr>
                        <td class="w-50 border">
                            Ташаббускор (буюртмачи номи )
                        </td>

                        <td class="w-50">
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td>
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td>
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td>
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Сотиб олинадиган махсулот тавсифи (техник характери)
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Махсулот келишининг муддати
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Алоҳида талаблар
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Махсулотга қўйилган бошқа талаблар (иш, хизмат)
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Махсулот сифати учун кафолат муддати (иш, хизмат)
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Харид режаси (сумма)
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)
                        </td>
                        <td>
                            <input type="text" id="name" name="name" class="focus:outline-none border" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот
                        </td>
                        <td>
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td>
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="w-4/12 px-4">
                <h5 class="text-center text-lg">Прикрепить файл</h5>
                <div class="w-full">
                    <div class="w-1/2 p-2 float-left">
                        <label class="border p-2 text-xs">
                            <input type="file" class="hidden"/>
                            <i class="fa fa-cloud-upload"></i> Основание
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="border p-2 text-xs">
                            <input type="file" class="hidden"/>
                            <i class="fa fa-cloud-upload"></i> Техническое задание
                        </label>
                    </div>
                </div>
                <div class="w-full p-2">
                    <div class="w-full border p-2 text-xs">
                        <label class="">
                            <input type="file" class="hidden"/>
                            <i class="fa fa-cloud-upload"></i> Другие документы необходимые для запуска закупочной процедуры
                        </label>
                    </div>
                </div>
                <div class="w-full">
                    <div class="w-full">
                        <div class="">
                            <label for="exampleFormControlTextarea1">Коментарий к заявке</label>
                            <textarea class="focus:outline-none border" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full" style="padding-left: 50%">
            <button class="bg-blue-500 p-2 rounded-md text-white">Сохранить и закрыть</button>
            <button class="bg-green-500 p-2 rounded-md text-white">Сохранить и отправить</button>
        </div>
    </div>
