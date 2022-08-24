
<?php $__env->startSection('center_content'); ?>
    <div id="section" class="pt-6">
        <a href="<?php echo e(route('site.applications.create')); ?>"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            <?php echo e(__('Создать')); ?>

        </a>
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table id="yajra-datatable">
                <thead>
                <tr>
                    <th><?php echo e(__('ФИО')); ?></th>
                    <th><?php echo e(__('Инициатор (наименование подразделения заказчика)')); ?></th>
                    <th><?php echo e(__('Наименование предмета закупки(товар, работа, услуги)')); ?></th>
                    <th><?php echo e(__('Ожидаемый срок поставки')); ?></th>
                    <th><?php echo e(__('Планируемый бюджет закупки (сумма)')); ?></th>
                    <th><?php echo e(__('Условия поставки по INCOTERMS (самовывоз со склада/доставка до покупателя)')); ?></th>
                    <th><?php echo e(__('Дата создания')); ?></th>
                    <th><?php echo e(__('Статус заявки')); ?></th>
                    <th><?php echo e(__('Действие')); ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    columnDefs: [
                        {
                            targets: "_all",
                            className: 'dt-body-center dt-head-center'
                        }],
                    order: [[ 0, "desc" ]],
                    processing: true,
                    serverSide: true,
                    ajax:
                        "<?php echo e(route('site.applications.status_table')); ?>",

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {
                            "data": "",
                            render: function (data, type, row) {
                                var details = row.planned_price + " " + row.currency ;
                                return details;
                            }
                        },
                        {data: 'incoterms', name: 'incoterms'},

                        {data: 'created_at', name: 'created_at'},
                        {data: 'status', name: 'status'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });


            });
            if(document.getElementById('status').value === 'Исполнена')
            {
                document.getElementById('status').style.backgroundColor = green;
            }
            console.log(document.getElementById('status'))
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/status.blade.php ENDPATH**/ ?>