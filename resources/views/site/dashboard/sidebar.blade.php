<div class="w-2/12 h-screen float-left bg-blue-500">
    <div class="w-10/12 mx-auto my-10">
        <img src="{{ asset('images/logo.png') }}" alt="">
    </div>
    <div class="border-t border-white">
        <div class="mt-4 w-10/12 mx-auto">
            <ul>
                <li class="py-2">
                    <i class="fas fa-user text-white mr-1"></i>
                    <a href="{{route('site.applications.index')}}" class="text-white hover:text-blue-200">Мои данные</a>
                </li>
                <li class="py-2">
                    <i class="far fa-address-card text-white mr-1"></i>
                    <a href="#" class="text-white hover:text-blue-200">Создать новую заявку</a>
                </li>
                <li class="py-2">
                    <i class="fas fa-desktop text-white mr-1"></i>
                    <a href="#" class="text-white hover:text-blue-200">Мониторинг моих заявок</a>
                </li>
                <li class="py-2">
                    <i class="fas fa-bookmark text-white mr-1"></i>
                    <a href="#" class="text-white hover:text-blue-200">База знаний</a>
                </li>
                <li class="py-2">
                    <i class="fas fa-sign-in-alt text-white mr-1"></i>
                    <a href="#" class="text-white hover:text-blue-200">Выход</a>
                </li>
            </ul>
        </div>
    </div>
</div>
