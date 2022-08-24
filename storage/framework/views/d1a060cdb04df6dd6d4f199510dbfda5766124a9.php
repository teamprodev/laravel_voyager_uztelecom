
<?php $__env->startSection('center_content'); ?>
<?php if(auth()->user()->branch_id != null && auth()->user()->department_id != null): ?>
    <head>
        <style>
            .dt-buttons{
                width: 100%;
            }
            .dt-body-center, .dt-body-right{
                font-size: 0.8rem;
            }
            .btn{
                font-size: 0.85rem !important;
                padding: 2px !important;
            }
            .btn-sm{
                font-size: 0.75rem !important;
                padding: 3px !important;
            }
        </style>
    </head>
<div id="section" class="pt-6">
    <a href="<?php echo e(route('site.applications.create')); ?>"
        class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
        <?php echo e(__('Создать')); ?>

    </a>
    <div class="pt-8 pb-16">
        <table id="yajra-datatable" class="display wrap responsive" style="width: 100%">
            <thead  class="text-center">
            <tr>
                <th>ID</th>
                <th><?php echo e(__('Статус заявки')); ?></th>
                <th><?php echo e(__('Номер Заявки')); ?></th>
                <th><?php echo e(__('Дата заявки')); ?></th>
                <th><?php echo e(__('Инициатор (наименование подразделения заказчика)')); ?></th>
                <th><?php echo e(__('Наименование предмета закупки(товар, работа, услуги)')); ?></th>
                <th><?php echo e(__('Ожидаемый срок поставки')); ?></th>
                <th><?php echo e(__('Планируемый бюджет закупки (сумма)')); ?></th>
                <th><?php echo e(__('Условия поставки по INCOTERMS')); ?></th>
                <th><?php echo e(__('Дата создания')); ?></th>
                <th><?php echo e(__('Действие')); ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<?php else: ?>
    <?php if(auth()->user()->department_id == null): ?>
        <h1 style="color: red; text-align:center;">Вы не выбрали ваш Отдел<br>Админ должен перенаправить вас в отдел</h1>
    <?php elseif(auth()->user()->branch_id == null): ?>
        <h1 style="color: red; text-align:center;">Вы не выбрали ваш Филиал<br>Админ должен перенаправить вас в филиал</h1>
    <?php endif; ?>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(function () {
            var table = $('#yajra-datatable').DataTable({
                responsive: true,
                columnDefs: [
                    {
                        targets: [0,1,2,3,4,5,6,8,9,10],
                        className: 'dt-body-center dt-head-center'
                    },
                    {
                        targets: 10,
                        className: 'not-exported'
                    },
                    {
                        targets: 7,
                        className: 'dt-body-right dt-head-center'}
                ],
                order: [[ 0, "desc" ]],
                "language": {
                    "lengthMenu": "Показать _MENU_ записей",
                    "info":      'Показаны записи в диапазоне от _START_ до _END_ (В общем _TOTAL_)',
                    "search":  "<?php echo e(__('Поиск')); ?>",
                    "paginate": {
                        "previous": "Назад",
                        "next": "Дальше"
                    }
                }, processing: false,
                serverSide: true,
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                            title: "Заявки",
                            titleAttr: 'Скопировать в буфер обмена',
                            exportOptions: {
                                columns: ':Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            title: "Заявки",
                            titleAttr: 'Экспорт в Excel',
                            exportOptions: {
                                columns: ':Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            title: "Заявки",
                            titleAttr: 'Экспорт в PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: ':Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            title: "Заявки",
                            titleAttr: 'Распечатать',
                            exportOptions: {
                                columns: ':Not(.not-exported)',
                                rows: ':visible',
                            },
                            customize: function(win)
                            {

                                var last = null;
                                var current = null;
                                var bod = [];

                                var css = '@page  { size: landscape; }',
                                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                                    style = win.document.createElement('style');

                                style.type = 'text/css';
                                style.media = 'print';

                                if (style.styleSheet)
                                {
                                    style.styleSheet.cssText = css;
                                }
                                else
                                {
                                    style.appendChild(win.document.createTextNode(css));
                                }

                                head.appendChild(style);
                            }
                        },
                        { extend: 'colvis',
                            text: '<i class="fas fa-eye"></i>',
                            titleAttr: 'Показать/скрыть колонки',
                            exportOptions: {
                                columns: ':Not(.not-exported)',
                                rows: ':visible',
                            },
                        }
                    ],
                    dom: {
                        button: {
                            className: 'dt-button'
                        }
                    }
                },
                dom: "Blfrtip",
                ajax:
                    "<?php echo e(route('site.applications.index')); ?>",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'status', name: 'status'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                    {data: 'initiator', name: 'initiator'},
                    {data: 'name', name: 'name'},
                    {data: 'delivery_date', name: 'delivery_date'},
                    {data: 'planned_price_curr', name: 'planned_price_curr'},
                    {data: 'incoterms', name: 'incoterms'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Develop\Panels\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/index.blade.php ENDPATH**/ ?>