<li class="nav-item menu-open">
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(route('site.applications.index')); ?>" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    <?php echo e(__('Все заявки')); ?>

                </p>
            </a>
        </li>
        <?php if(auth()->user()->branch_id != null && auth()->user()->department_id != null): ?>
        <?php if(auth()->user()->hasPermission('select_branch')): ?>
        <li class="nav-item">
            <a href="<?php echo e(route('branches.view')); ?>" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    <?php echo e(__('Заявки по филиалу')); ?>

                </p>
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <button data-toggle="collapse" data-target="#demo" class="nav-link">
                <div class="float-left">
                    <div>
                        <i class="nav-icon fas fa-sort float-left"></i>
                        <p><?php echo e(__('Статусы')); ?></p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <?php if(auth()->user()->role_id != 7): ?>
                        <a href="<?php echo e(route('site.applications.show_status', 'new')); ?>" id="demo" class="collapse">
                              <i class="nav-icon fas fa-chevron-right"></i>
                              <p><?php echo e(__('Новая')); ?></p>
                          </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'in_process')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('На рассмотрении')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'accepted')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Принята')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'refused')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Отказана')); ?></p>
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('site.applications.show_status', 'agreed')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Согласован')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'rejected')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Отказ')); ?></p>
                        </a>

                        <a href="<?php echo e(route('site.applications.show_status', 'distributed')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Распределен')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status','cancelled')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Отменен')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'performed')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Исполнен')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.applications.show_status', 'overdue')); ?>" id="demo" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('Просрочен')); ?></p>
                        </a>
                            <a href="<?php echo e(route('site.applications.performer_status_get')); ?>" id="demo" class="collapse">
                                <i class="nav-icon fas fa-chevron-right"></i>
                                <p><?php echo e(__('Статус испольнителя')); ?></p>
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
                        <p><?php echo e(__('Отчеты')); ?></p>
                    </div>
                    <div class="d-flex align-items-start flex-column">
                        <a href="<?php echo e(route('site.report.index', '1')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('1 отчет')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '2')); ?>" id="report" class="collapse">
                          <i class="nav-icon fas fa-chevron-right"></i>
                          <p><?php echo e(__('2 отчет квартальный итоговый')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '22')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('2 отчет квартальный плановый')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '3')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('3-отчет за год')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '4')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('4-отчет за год')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '5')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('5 отчет свод  общий')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '6')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('6 отчет свод  общий')); ?></p>

                        <a href="<?php echo e(route('site.report.index', '7')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('7 отчет плановый')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '8')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('8 отчет по видам закупки')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '9')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('9 отчет плановый')); ?></p>
                        </a>
                        <a href="<?php echo e(route('site.report.index', '10')); ?>" id="report" class="collapse">
                            <i class="nav-icon fas fa-chevron-right"></i>
                            <p><?php echo e(__('за год')); ?> </p>
                        </a>
                        </a>
                    </div>
                </div>
            </button>
        </li>
        <?php if(auth()->user()->branch_id != null): ?>
        <li class="nav-item">
            <a href="<?php echo e(route('site.applications.create')); ?>" class="nav-link">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>
                    <?php echo e(__('Создать заявку')); ?>

                </p>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item">
            <a href="<?php echo e(route('site.applications.drafts')); ?>" class="nav-link">
                <i class="nav-icon fas fa-file-text"></i>
                <p>
                    <?php echo e(__('Черновик')); ?>

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('site.faqs.index')); ?>" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                    <?php echo e(__('База знаний')); ?>

                </p>
            </a>
        </li>
    </ul>
</li>
<?php /**PATH D:\ArabicDev\Projects\Uztelecom\Project\laravel_voyager_uztelecom\resources\views/site/dashboard/menu.blade.php ENDPATH**/ ?>