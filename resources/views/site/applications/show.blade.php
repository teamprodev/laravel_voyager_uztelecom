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
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad corporis culpa distinctio
                                dolorem doloribus error, eveniet facere inventore laboriosam nulla numquam officia porro
                                quod quos repellat, repellendus repudiandae ullam, vel!</p>
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид мазмуни (сотиб олиш учун асос)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none focus:outline-none h-16 border w-full" name="" id="" cols="30"
                                      rows="5"></textarea>
                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Асос (харидлар режаси, раҳбарият томонидан билдирги)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30"
                                      rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30"
                                      rows="5"></textarea>

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
                            Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб
                            бериш)
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <input type="text" class="focus:outline-none h-16 border w-full">

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича
                            маълумот
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30"
                                      rows="5"></textarea>

                        </td>
                    </tr>
                    <tr class="h-16">
                        <td class="w-50 border p-2 font-semibold">
                            Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот
                        </td>
                        <td class="w-50 border p-2 font-normal">
                            <textarea class="resize-none h-16 focus:outline-none border w-full" name="" id="" cols="30"
                                      rows="5"></textarea>

                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        @if(auth()->user()->role_id == 4)

        <div class="w-full text-right py-4 pr-10">
            <form action="{{route('site.applications.vote', ['application' => $application->id])}}"
                  method="POST">
                @method('put')
                @csrf
                <input hidden name="status" value="2"/>

                <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md
            text-white">Done
                </button>
            </form>

            <button class="bg-red-500 hover:bg-red-700 p-2 transition duration-300 rounded-md modal-cancel
            text-white">Cancel
            </button>
        </div>
        @endif

    </div>
    @if(auth()->user()->role_id == 4)
        <div id="defaultModal" aria-hidden="true"
             class="hidden modal-window mx-auto overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0"
             style="background-color:rgba(0,0,0,0.5)">
            <div class="relative px-4 w-11/12 mx-auto mt-24 max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->

                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button"
                                class="closemodal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{route('site.applications.vote', ['application' => $application->id])}}"
                          method="POST">
                        <!-- Modal body -->
                        @method('put')
                        @csrf
                        <div class="p-6 space-y-6">
                        <textarea name="comment" class="border-2 border-black rounded" required id="" cols="77"
                                  rows="10"></textarea>

                            <input hidden name="status" value="1"/>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button data-modal-toggle="defaultModal" type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                I accept
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    @endif

@endsection
