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
            <button data-toggle="collapse" data-target="#demo" class="nav-link">
                <div class="float-left">
                    <div>
                        <i class="nav-icon fas fa-sort float-left"></i>
                        {{ __('lang.status') }}
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <a href="{{route('site.applications.status', 'new')}}" id="demo" class="collapse">
                              <i class="nav-icon fas fa-chevron-right"></i>
                              <p>{{ __('lang.status_new') }}</p>
                          </a>
                        <a href="{{route('site.applications.status', 'process')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_in_process') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'accepted')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_accepted') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'refused')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_refused') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'agreed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_agreed') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'rejected')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_rejected') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'distributed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_distributed') }}</p>
                        </a>
                        <a href="{{route('site.applications.status','cancelled')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_cancelled') }}</p>
                        </a>
                        <a href="{{route('site.applications.status', 'performed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.performed') }}</p>
                        </a>
                    </div>
                </div>
            </button>
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
