<ul>
    <div class=" my-4 py-2 text-xs{{Request::is(app()->getLocale()."/site/applications") ? " border-2 border-white":''}} hover:border-2 hover:border-white rounded-md">
        <a href="{{route('site.applications.index')}}" class="block py-1 md:py-3 pl-2 align-middle no-underline hover:text-white text-white">
            <i class="fas fas fa-desktop text-lg pr-0 md:pr-3"></i><span class="text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">Мои сохраненные заявки</span>
        </a>
    </div>
    <div class=" my-4 py-2 text-xs{{Request::is(app()->getLocale()."/site/applications/create") ? " border-2
    border-white":''}}
            hover:border-2 hover:border-white rounded-md">
        <a href="{{route('site.applications.create')}}" class="block py-1 md:py-3 pl-2 align-middle no-underline hover:text-white text-white">
            <i class="far fa-address-card text-lg pr-0 md:pr-3"></i><span class=" text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">Создать заявку</span>
        </a>
    </div>
    <div class=" my-4 py-2 text-xs{{Request::is(app()->getLocale()."/site/faqs") ? " border-2 border-white":''}} hover:border-2 hover:border-white rounded-md">
        <a href="{{route('site.faqs.index')}}" class="block py-1 md:py-3 pl-2 align-middle no-underline hover:text-white text-white">
            <i class="fas fa-bookmark text-lg pr-0 md:pr-3"></i><span class="text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">База знаний</span>
        </a>
    </div>
</ul>
