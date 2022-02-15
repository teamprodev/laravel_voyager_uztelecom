<ul>
    <li class=" my-4 py-2 text-xs{{Request::is("ru/site/applications") ? " border-2 border-white":''}} hover:border-2 hover:border-white rounded-xl">
        <a href="{{route('site.applications.index')}}" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-white text-white">
            <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">Мои сохраненные заявки</span>
        </a>
    </li>
    <li class=" my-4 py-2 text-xs{{Request::is("ru/site/applications/create") ? " border-2 border-white":''}} hover:border-2 hover:border-white rounded-xl">
        <a href="{{route('site.applications.create')}}" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-white text-white">
            <i class="fas fa-tasks pr-0 md:pr-3"></i><span class=" text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">Мои сохраненные заявки</span>
        </a>
    </li>
    <li class=" my-4 py-2 text-xs{{Request::is("ru/site/faqs") ? " border-2 border-white":''}} hover:border-2 hover:border-white rounded-xl">
        <a href="{{route('site.faqs.index')}}" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-white text-white">
            <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="text-white pb-1 md:pb-0 text-xs md:text-sm block md:inline-block">Мои сохраненные заявки</span>
        </a>
    </li>
</ul>
