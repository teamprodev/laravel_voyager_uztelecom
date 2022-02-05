<ul>
    @foreach($items as $menu_item)
        <li class="py-2">
            <i class="fas fa-bookmark text-white mr-1"></i>
            <a class="text-white hover:text-blue-200" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
        </li>
    @endforeach
</ul>
