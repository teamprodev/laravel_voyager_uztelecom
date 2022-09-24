<li class="nav-item menu-open">
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('site.applications.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    {{ __('Все заявки') }}
                </p>
            </a>
        </li>
        @if(auth()->user()->branch_id != null && auth()->user()->department_id != null)
        @if(auth()->user()->hasPermission('select_branch'))
        <li class="nav-item">
            <a href="{{route('branches.view')}}" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    {{ __('Заявки по филиалу') }}
                </p>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <button data-toggle="collapse" data-target="#demo" class="nav-link">
                <div class="float-left">
                    <div>
                        <i class="nav-icon fas fa-sort float-left"></i>
                        <p>{{ __('Статусы') }}</p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        @if(auth()->user()->role_id != 7)
                        <a href="{{route('site.applications.show_status', 'new')}}" id="demo" class="collapse">
                              <i class="nav-icon fas fa-chevron-right"></i>
                              <p>{{ __('Новая') }}</p>
                          </a>
                        <a href="{{route('site.applications.show_status', 'in_process')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('На рассмотрении') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'refused')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Отказана') }}</p>
                        </a>
                        @endif
                        <a href="{{route('site.applications.show_status', 'agreed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Согласован') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'rejected')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Отказ') }}</p>
                        </a>

                        <a href="{{route('site.applications.show_status', 'distributed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Распределен') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status','cancelled')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Отменен') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'performed')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Исполнен') }}</p>
                        </a>
                        <a href="{{route('site.applications.show_status', 'overdue')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('Просрочен') }}</p>
                        </a>
                        <a href="{{route('site.applications.to_sign')}}" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('На подпись') }}</p>
                        </a>
                            <a href="{{route('site.applications.performer_status_get')}}" id="demo" class="collapse">
                                <i class="nav-icon fas fa-chevron-right"></i>
                                <p>{{ __('Статус испольнителя') }}</p>
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
                        <p>{{__('Отчеты')}}</p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <a href="{{route('site.report.index', '1')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{__('1 отчет')}}</p>
                        </a>
                        <a href="{{route('site.report.index', '2')}}" id="report" class="collapse">
                          <i class="nav-icon fas fa-chevron-right"></i>
                          <p>{{ __('2 отчет квартальный итоговый') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '22')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('2 отчет квартальный плановый') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '3')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('3-отчет за год') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '4')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('4-отчет за год') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '5')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('5 отчет свод  общий') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '6')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('6 отчет свод  общий') }}</p>

                        <a href="{{route('site.report.index', '7')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('7 отчет плановый') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '8')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('8 отчет по видам закупки') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '9')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('9 отчет плановый') }}</p>
                        </a>
                        <a href="{{route('site.report.index', '10')}}" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p>{{ __('за год') }} </p>
                        </a>
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
                    {{ __('Создать заявку') }}
                </p>
            </a>
        </li>
        @endif
        @endif
        <li class="nav-item">
            <a href="{{route('site.applications.drafts')}}" class="nav-link">
                <i class="nav-icon fas fa-file-text"></i>
                <p>
                    {{ __('Черновик') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('site.faqs.index')}}" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                    {{ __('База знаний') }}
                </p>
            </a>
        </li>
    </ul>
</li>
