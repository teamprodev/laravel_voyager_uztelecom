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
