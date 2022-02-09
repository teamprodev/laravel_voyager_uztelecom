<ul>
    @foreach($items as $menu_item)
        <li class="py-2 text-xs">
            <a href="{{ $menu_item->link() }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-sm text-gray-400 md:text-gray-200 block md:inline-block">{{ $menu_item->title }}</span>
            </a>
        </li>
    @endforeach
</ul>
