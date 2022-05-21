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
                        <p>{{ __('lang.status') }}</p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <a href="{{route('site.applications.show_status', 'new')}}" id="demo" class="collapse">
                              <i class="nav-icon fas fa-chevron-right"></i>
                              <p>{{ __('lang.status_new') }}</p>
                          </a>
                        <a href="{{route('site.applications.show_status', 'in_process')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_in_process') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'accepted')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_accepted') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'refused')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_refused') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'agreed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_agreed') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'rejected')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_rejected') }}</p>
                        </a>

                        <a href="{{route('site.applications.show_status', 'distributed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_distributed') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status','cancelled')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.status_cancelled') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'performed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.performed') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'overdue')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('lang.overdue') }}</p>
                        </a>
                    </div>
                </div>
            </button>
        </li>
        <li class="nav-item">
            <button data-toggle="collapse" data-target="#report" class="nav-link">
                <div class="float-left">
                    <div>
                        <i class="nav-icon fas fa-sort float-left"></i>
                        <p>Отчеты</p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <a href="{{route('site.report.index', '1')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>1 отчет</p>
                        </a>
                        <a href="{{route('site.report.index', '2')}}" id="report" class="collapse">
                          <i class="nav-icon fas fa-chevron-right"></i>
                          <p>2 отчет квартальный итоговый</p>
                        </a>
                        <a href="{{route('site.report.index', '22')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>2 отчет квартальный плановый</p>
                        </a>
                        <a href="{{route('site.report.index', '3')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>3-отчет за год</p>
                        </a>
                        <a href="{{route('site.report.index', '4')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>4-отчет за год</p>
                        </a>
                        <a href="{{route('site.report.index', '5')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>5 отчет свод  общий</p>
                        </a>
                        <a href="{{route('site.report.index', '8')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>8 отчет свод  общий</p>
                        </a>
                        <a href="{{route('site.report.index', '10')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>10-отчет за год</p>
                        </a>
                    </div>
                </div>
            </button>
        </li>
        @if(auth()->user()->branch_id != null)
        <li class="nav-item">
            <a href="{{route('site.applications.create')}}" class="nav-link">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>
                    {{ __('lang.create_application') }}
                </p>
            </a>
        </li>
        @endif
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
