<li class="nav-item menu-open">
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('site.applications.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    {{ __('lang.applications') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('site.applications.create')}}" class="nav-link">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>
                    {{ __('lang.create_application') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('site.applications.drafts')}}" class="nav-link">
                <i class="nav-icon fas fa-file-text"></i>
                <p>
                    {{ __('lang.drafts') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('site.faqs.index')}}" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                    {{ __('lang.faq') }}
                </p>
            </a>
        </li>
    </ul>
</li>
