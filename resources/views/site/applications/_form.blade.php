@extends('site.layouts.wrapper')

@section('center_content')
    <div class="w-9/12 mx-auto shadow-md ml-72 my-6">
        <div class="w-full flex">
            <div class="w-10/12 p-6">
                <table class="table-auto">
                    <tbody>
                    <tr>
                        <td class="w-50 border p-2">
                            Ташаббускор (буюртмачи номи )
                        </td>

                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none w-full border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>
                        </td>

                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td class="w-50 border p-2">
                            <textarea class="focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td class="w-50 border p-2">
                            <textarea class="focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td class="w-50 border p-2">
                            <textarea class="focus:outline-none border" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Сотиб олинадиган махсулот тавсифи (техник характери)
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Махсулот келишининг муддати
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Алоҳида талаблар
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Махсулотга қўйилган бошқа талаблар (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Махсулот сифати учун кафолат муддати (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Харид режаси (сумма)
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)
                        </td>
                        <td class="w-50 border p-2">
                            <input type="text" id="name" name="name" class="focus:outline-none border w-full" value="{{ old('name', isset($transactionType) ? $transactionType->name : '') }}" required>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот
                        </td>
                        <td class="w-50 border p-2">
                            <textarea class="focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50 border p-2">
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td class="w-50 border p-2">
                            <textarea class="focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="w-4/12 px-4">
                <h5 class="text-center text-lg">Прикрепить файл</h5>
                <div class="w-full flex ">
                    <div class="p-2 float-left">
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
                <div class="w-full mt-4 px-2">
                    <div class="w-full">
                        <div class="">
                            <label for="exampleFormControlTextarea1">Коментарий к заявке</label>
                            <textarea class="focus:outline-none border w-full" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full text-right py-4 pr-10">
            <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
            <button class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
        </div>
    </div>
@endsection
