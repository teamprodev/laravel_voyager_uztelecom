
<?php $__env->startSection('center_content'); ?>
    <div id="section" class="pt-6">
        <a href="<?php echo e(route('site.applications.create')); ?>"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            <?php echo e(__('Создать')); ?>

        </a>
        <div class="w-11/12 mx-auto pt-8 pb-16">

            <?php echo e(Aire::open()
      ->route('branches.putCache')
      ->enctype("multipart/form-data")
      ->post()); ?>

            <div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
                <?php echo e(Aire::select($branch, 'select', 'Филиал')->value(Illuminate\Support\Facades\Cache::get('branch_id'))->name('branch_id')); ?>


                <button type="submit" class="btn btn-success" style="margin-top: 8px;">Выбрать</button>
            </div>
            <?php echo e(Aire::close()); ?>

            <?php if(Illuminate\Support\Facades\Cache::get('branch_id') != null): ?>
                <table id="yajra-datatable" class="display wrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo e(__('Заявки')); ?></th>
                        <th><?php echo e(__('Дата заявки')); ?></th>
                        <th><?php echo e(__('Инициатор (наименование подразделения заказчика)')); ?></th>
                        <th><?php echo e(__('Филиал')); ?></th>
                        <th><?php echo e(__('Наименование предмета закупки(товар, работа, услуги)')); ?></th>
                        <th><?php echo e(__('Ожидаемый срок поставки')); ?></th>
                        <th><?php echo e(__('Планируемый бюджет закупки (сумма)')); ?></th>
                        <th><?php echo e(__('Условия поставки по INCOTERMS')); ?></th>
                        <th><?php echo e(__('Дата создания')); ?></th>
                        <th><?php echo e(__('Дата обновления')); ?></th>
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
                            targets: [0,1,2,3,4,5,6,8,9,10,11,12],
                            className: 'dt-body-center dt-head-center'
                        },
                        {
                            targets: 7,
                            className: 'dt-body-right dt-head-center'
                        }
                    ],
                    order: [[ 0, "desc" ]],
                    processing: true,
                    serverSide: true,
                    ajax:
                        "/branches/ajax_branch",

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'number', name: 'number'},
                        {data: 'date', name: 'date'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'branch_initiator_id', name: 'branch_initiator_id'},
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
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'status', name: 'status'},
                        {
                            data: 'action',
                            name: 'action',
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/vendor/voyager/branches/view.blade.php ENDPATH**/ ?>