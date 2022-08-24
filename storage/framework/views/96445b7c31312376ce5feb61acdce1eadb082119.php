<?php if($application->performer_role_id == auth()->user()->role_id): ?>
<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    <?php echo e(Aire::select($branch, 'select', __('Филиал заказчик по контракту'))
                        ->name('branch_customer_id')
                        ->value($application->branch_customer_id)); ?>

                    <?php echo e(Aire::input('bio', __('Номер лота'))
                        ->name('lot_number')
                        ->value($application->lot_number)); ?>

                    <?php echo e(Aire::input('bio', __('Номер договора'))
                        ->name('contract_number')
                        ->value($application->contract_number)); ?>.
                    <?php echo e(Aire::date('date_input', __('Дата договора'))
                        ->name('contract_date')
                        ->value($application->contract_date)); ?>

                    <?php echo e(Aire::input('bio', __('Дата протокола'))
                        ->name('protocol_date')
                        ->value($application->protocol_date)); ?>

                    <?php echo e(Aire::input('bio', __('Номер протокола'))
                        ->name('protocol_number')
                        ->value($application->protocol_number)); ?>

                    <?php echo e(Aire::textArea('bio', __('Предмет договора (контракта) и краткая характеристика'))
                        ->name('contract_info')
                        ->value($application->contract_info)
                        ->rows(3)
                        ->cols(40)); ?>

                    <?php echo e(Aire::checkbox('checkbox', __('С НДС'))
                       ->name('with_nds')); ?>

                    <?php echo e(Aire::input('bio', __('Общая реальная сумма'))
                        ->name('contract_price')
                        ->value($application->contract_price)); ?>

                </div>
                <div class="pt-2 pb-2 w-50">
                    <?php echo e(Aire::select($countries,'bio', __('Товары (обслуживание) страна изготовленной'))
                        ->name('country_produced_id')
                        ->value($application->country_produced_id)); ?>



                    <?php echo e(Aire::input('bio', __('Наименование поставщика'))
                        ->name('supplier_name')
                        ->value($application->supplier_name)); ?>

                    <?php echo e(Aire::input('bio', __('Поставщик Перемешать номер'))
                        ->name('supplier_inn')
                        ->value($application->supplier_inn)); ?>

                    <?php echo e(Aire::textArea('bio', __('Информация о товаре'))
                        ->name('product_info')
                        ->value($application->product_info)
                        ->rows(3)
                        ->cols(40)); ?>


                    <div class="mr-4 pt-2 pb-2 w-50">
                        <?php echo e(Aire::select($subject, 'select', __('Предмет закупки'))
                            ->name('subject')
                            ->value($application->subject)); ?>

                        <?php if($performer_file != 'null' && $performer_file != null): ?>
                            <div class="mb-5" style="width: 80%">
                                <h5 class="text-left">Performer File</h5>
                                <?php $__currentLoopData = $performer_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg')): ?>
                                        <img src="/storage/uploads/<?php echo e($file); ?>" width="500" height="500" alt="not found">
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary"><a style="color: white;" href="/storage/uploads/<?php echo e($file); ?>"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></a></button>
                                        <p class="my-2"><?php echo e(preg_replace('/[0-9]+_/', '', $file)); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        <?php echo e(Aire::select($purchase, 'select', __('Вид закупки'))
                            ->name('type_of_purchase_id')
                            ->value($application->type_of_purchase_id)); ?>

                    </div>
                    <?php echo e(Aire::select($status_extented, 'select')
                        ->name('status')
                        ->name('status')
                        ->value($application->status)); ?>

                    <div id="file"></div>
                    <div id="a" class="hidden mb-3">
                        <label for="message-text" class="col-form-label"><?php echo e(__('Комментарий')); ?>:</label>
                        <input class="form-control" name="report_if_cancelled" id="report_if_cancelled">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button type="submit" class="btn btn-success"><?php echo e(__('Сохранить')); ?></button>
    </div>
    <script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.js"></script>
    <script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.legacy.min.js" nomodule></script>
    <script src="https://releases.transloadit.com/uppy/locales/v2.0.5/ru_RU.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var uppy = new Uppy.Core({
            debug: true,
            autoProceed: true,
            restrictions: {
                minFileSize: null,
                maxFileSize: 10000000,
                maxTotalFileSize: null,
                maxNumberOfFiles: 10,
                minNumberOfFiles: 0,
                allowedFileTypes: null,
                requiredMetaFields: [],
            },
            meta: {},
            onBeforeFileAdded: (currentFile, files) => currentFile,
            onBeforeUpload: (files) => {
            },
            locale: {
                strings: {
                    browseFiles: 'прикрепить файл',
                    dropPasteFiles: '%{browseFiles}',
                }
            },
            store: new Uppy.DefaultStore(),
            logger: Uppy.justErrorsLogger,
            infoTimeout: 5000,
        })
            .use(Uppy.Dashboard, {
                trigger: '.UppyModalOpenerBtn',
                inline: true,
                target: '#file',
                showProgressDetails: true,
                note: 'Все типы файлов, до 10 МБ',
                width: 300,
                height: 200,
                metaFields: [
                    {id: 'name', name: 'Name', placeholder: 'file name'},
                    {id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'}
                ],
                browserBackButtonClose: true
            })
            .use(Uppy.XHRUpload, {
                endpoint: '<?php echo e(route('uploadImage', $application->id)); ?>',
                formData: true,
                fieldName: 'performer_file',
                headers: file => ({
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }),
            });
        uppy.on('upload-success', (file, response) => {
            const httpStatus = response.status // HTTP status code
            const httpBody = response.body   // extracted response data
            // do something with file and response
        });
        uppy.on('file-added', (file) => {
            uppy.setFileMeta(file.id, {
                size: file.size,
            })
            console.log(file.name);
        });
        uppy.on('complete', result => {
            console.log('successful files:', result.successful)
            console.log('failed files:', result.failed)
        });
    </script>
</div>
<?php else: ?>
    <h3 style="text-align:center;color:red;"><?php echo e(__('Руководство не выбрало вас')); ?></h3>
<?php endif; ?>

<?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/performer.blade.php ENDPATH**/ ?>