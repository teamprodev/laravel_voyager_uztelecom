@extends('site.layouts.wrapper')

@section('center_content')


    <div class="mt-6">
        <div class="w-full flex">
            <div class="p-6">
                <table class="table-auto">
                    <tbody>
                    <tr class="h-16">
                        <td class="xl:w-3/6 md:w-4/6 border p-2 font-semibold">
                            Ташаббускор (буюртмачи номи )
                        </td>

                        <td class="w-50 border p-2 font-normal">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad corporis culpa distinctio dolorem doloribus error, eveniet facere inventore laboriosam nulla numquam officia porro quod quos repellat, repellendus repudiandae ullam, vel!</p>
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none focus:outline-none h-16 border w-full" name="" id="" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот тавсифи (техник характери)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none  h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот келишининг муддати
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Алоҳида талаблар
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотга қўйилган бошқа талаблар (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулот сифати учун кафолат муддати (иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none border h-16 w-full" value="">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид режаси (сумма)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input id="amount" name="amount" type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30" rows="5"></textarea>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
