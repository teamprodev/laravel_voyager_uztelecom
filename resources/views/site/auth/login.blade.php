<section class="bg-blueGray-50">

    <!--Modal-->
    <div class="w-full h-full mt-28 flex items-center justify-center">

        <div class="bg-white w-11/12 md:max-w-lg mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="py-2 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center ">
                    <div class="w-5/12 mx-auto">
                        <img src="https://play-lh.googleusercontent.com/hSzPUT2DXP3uruTclgEZjWY6kW-AIGXwg8CRpzCrZPfGuurdi3NHjgGVtbtS2uqmVtI=h500"
                             alt="">
                    </div>
                </div>

                <!--Body-->
                <form name="eri_form" action="{{route('eri.login')}}" id="eri_form" method="post">
                @csrf
                <div>
                        <label class="text-xs" for="">Калитни танланг</label>
                        <select name="key" class="w-full" onchange="cbChanged(this)"></select>

                    </div>


                    <div hidden id="keyId" class="none"></div>

                    <input type="hidden" name="eri_fullname" id="eri_fullname">
                    <input type="hidden" name="eri_inn" id="eri_inn">
                    <input type="hidden" name="eri_pinfl" id="eri_pinfl">
                    <input type="hidden" name="eri_sn" id="eri_sn">
                    <textarea hidden class="none" name="eri_data" id="eri_data">Authorization</textarea>
                    <textarea hidden class="none" name="eri_hash" id="eri_hash"></textarea>


                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button class="px-4 bg-blue-500 py-2 rounded-lg text-white hover:bg-blue-400" id="eri_sign"
                                onclick="sign()">
                            Вход
                        </button>
                        <button class="px-4 bg-blue-500 py-2 rounded-lg text-white hover:bg-blue-400" id="eri_sign"
                                onclick="uiLoadKeys
                    ()">Yangilash
                        </button>

                    </div>
                </form>


            </div>
        </div>
    </div>

</section>
