
<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <h5><strong><?php echo e(__('Визирование заявки через :')); ?> </strong>
                <?php if($application->is_more_than_limit == 1): ?>
                    Компанию
                <?php elseif($application->is_more_than_limit == '0'): ?>
                    Филиала
                <?php endif; ?>
            </h5>
            <div class="mb-3 row">
                <label class="col-sm-6" for="initiator" class="col-sm-2 col-form-label"><?php echo e(__('Инициатор (наименование подразделения заказчика)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::input()
                        ->name("initiator")
                        ->value($application->initiator)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="purchase_basis" class="col-sm-2 col-form-label"><?php echo e(__('Цель / содержание закупки (обоснование необходимости закупки)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("purchase_basis")
                        ->value($application->purchase_basis)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="basis" class="col-sm-2 col-form-label"><?php echo e(__('Основания (план закупок, рапорт,распоряжение руководства)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("basis")
                        ->value($application->basis)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="name" class="col-sm-2 col-form-label"><?php echo e(__('Наименование предмета закупки(товар, работа, услуги)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::input()
                        ->name("name")
                        ->value($application->name)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="specification" class="col-sm-2 col-form-label"><?php echo e(__('Описание предмета закупки (технические характеристики)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("specification")
                        ->value($application->specification)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label"><?php echo e(__('Ожидаемый срок поставки')); ?></label>
                <div class="col-sm-6">
                    <input class="form-control" id="date" name="delivery_date" value="<?php echo e($application->delivery_date); ?>" type="date"/>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="separate_requirements" class="col-sm-2 col-form-label"><?php echo e(__('Особые требования')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("separate_requirements")
                        ->value($application->separate_requirements)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="other_requirements" class="col-sm-2 col-form-label"><?php echo e(__('Дополнительные требования')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("other_requirements")
                        ->value($application->other_requirements)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label"><?php echo e(__('Гарантийный срок качества товара (работ, услуг)')); ?></label>
                <div class="col-sm-6">
                    <input class="form-control" id="date" name="expire_warranty_date" value="<?php echo e($application->expire_warranty_date); ?>" type="date"/>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="planned_price" class="col-sm-2 col-form-label"><?php echo e(__('Планируемый бюджет закупки (сумма)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::number()
                        ->name("planned_price")
                        ->id("planned_price")
                        ->value($application->planned_price , 0 , '' , ' ')
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="incoterms" class="col-sm-2 col-form-label"><?php echo e(__('Условия поставки по INCOTERMS (самовывоз со склада/доставка до покупателя)')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("incoterms")
                        ->value($application->incoterms)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="info_business_plan" class="col-sm-2 col-form-label"><?php echo e(__('Департамент по планированию бюджета - информация о существовании товара закупок в бизнес-плане')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::input()
                        ->name("info_business_plan")
                        ->value($application->info_business_plan)
                        ->class("form-control")); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="info_purchase_plan" class="col-sm-2 col-form-label"><?php echo e(__('Информация о наличии в «Плане закупок» приобретаемых товаров')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("info_purchase_plan")
                        ->value($application->info_purchase_plan)
                        ->cols(40)
                        ->class("form-control")); ?>

                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="comment" class="col-sm-2 col-form-label"><?php echo e(__('Комментарий')); ?></label>
                <div class="col-sm-6">
                    <?php echo e(Aire::textArea()
                        ->rows(3)
                        ->name("comment")
                        ->value($application->comment)
                        ->cols(40)
                        ->class("form-control")
                        ->required()); ?>

                </div>
                <?php if($application->with_nds == 1): ?>
                <?php echo e(Aire::checkbox('checkbox', __('lang.performer_nds'))
                            ->checked()
                       ->name('with_nds')); ?>

                <?php else: ?>
                <?php echo e(Aire::checkbox('checkbox', __('lang.performer_nds'))
                   ->name('with_nds')); ?>

                  <?php endif; ?>
        </div>
            <?php if(isset($application->resource_id)): ?>
                <b><?php echo e(__('lang.resource')); ?></b>:
                <?php $__currentLoopData = json_decode($application->resource_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <br> <?php echo e(\App\Models\Resource::find($product)->name); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <div class="mb-3 row">
            <label for="currency" class="col-sm-6 col-form-label"><?php echo e(__('lang.valyuta')); ?></label>
                <select class="form-control col-sm-6" name="currency" id="currency">
                    <option value="UZS" <?php if($application->currency === "UZS"): ?> selected <?php endif; ?>>UZS</option>
                    <option value="USD" <?php if($application->currency === "USD"): ?> selected <?php endif; ?>>USD</option>
                </select>
            </div>

            <?php if($application->is_more_than_limit == '1'): ?>
                <?php echo e(Aire::checkboxGroup($company_signers, 'radio', __('lang.signers'))
                    ->name('signers[]')
                    ->value(json_decode($application->signers))
                    ->multiple()); ?>

            <?php elseif($application->is_more_than_limit != '1' ): ?>
                <?php echo e(Aire::checkboxGroup($branch_signers, 'radio', __('lang.signers'))
                    ->name('signers[]')
                    ->value(json_decode($application->signers))
                    ->multiple()); ?>

            <?php endif; ?>
        </div>
        <div class="flex-direction: column">
            <?php if($application->file_basis === 'null' ||$application->file_basis === null): ?>
                <div class="mx-1">
                    <h6 class="my-3"><?php echo e(__('lang.base')); ?></h6>
                    <div id="file_basis"></div>
                </div>
            <?php endif; ?>
            <?php if($application->file_tech_spec === 'null' ||$application->file_tech_spec === null): ?>
                <div class="mx-1">
                    <h6 class="my-3"><?php echo e(__('lang.tz')); ?></h6>
                    <div id="file_tech_spec"></div>
                </div>
            <?php endif; ?>
            <?php if($application->other_files === 'null' ||$application->other_files === null): ?>
                <div class="mx-1">
                    <h6 class="my-3"><?php echo e(__('Другие файлы')); ?></h6>
                    <div id="other_files"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if($application->resource_id === null): ?>
    <input id="resource_id" name="resource_id" value=null class="hidden" type="text">
    <table id="table"></table>
<?php endif; ?>
<script src="https://unpkg.com/jquery.appendgrid@2.0.0/dist/AppendGrid.js"></script>

<script>
    const resource_id = document.getElementById('resource_id').value = {};
    var myAppendGrid = new AppendGrid({
        element: "table",
        uiFramework: "bootstrap4",
        iconFramework: "fontawesome5",
        columns: [
            {
                name: "resource_id",
                display: "Product",
                type: "select",
                ctrlOptions: <?php echo json_encode($products,JSON_UNESCAPED_UNICODE); ?>,
                afterRowRemoved: function(rowIndex) {
                    if (removeRow(rowIndex)){
                        console.log(document.getElementById('resource_id').value)
                        document.getElementById('resource_id').value = null
                        console.log(document.getElementById('resource_id').value)
                    }

                },
                events: {
                    // Add change event
                    change: function(e) {
                        if (e.target.value) {
                            e.target.style.backgroundColor = "#99FF99";
                            resource_id[e.uniqueIndex] = e.target.value;
                            console.log(resource_id)
                        } else {
                            e.target.style.backgroundColor = null;
                        }
                    }
                }
            },
        ],
        // Optional CSS classes, to make table slimmer!
        sectionClasses: {
            table: "table-sm",
            control: "form-control-sm",
            buttonGroup: "btn-group-sm"
        }
    });
    function functionMy()
    {
            var thestring = "";
            for (let i in resource_id) {
                thestring += resource_id[i] + ",";
            }
            thestring = thestring.substring(0, thestring.length -2);

            console.log(document.getElementById('resource_id').value = thestring);
            console.log(typeof thestring);
    }
</script>
<div class="px-6">
    <table id="yajra-datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th><?php echo e(__('Статус заявки')); ?></th>
            <th><?php echo e(__('Роль')); ?></th>
            <th><?php echo e(__('Комментарий')); ?></th>
            <th><?php echo e(__('Пользователь')); ?></th>
            <th>Дата подписи</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(function () {
        var table = $('#yajra-datatable').DataTable({
            "language": {
                "emptyTable": "Нет информации в таблица"
            },
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('site.applications.list.signedocs',$application->id)); ?>",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'status', name: 'status'},
                {data: 'role_id', name: 'role_id'},
                {data: 'comment', name: 'comment'},
                {data: 'user_id', name: 'user_id'},
                {data: 'updated_at', name: 'updated_at'},
            ]
        });
    })
</script>
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
            name="draft" value="1">
        <?php echo e(__('lang.save_close')); ?>

    </button>
    <button onclick="functionMy()" class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
            name="draft" value="0">
        <?php echo e(__('lang.save_send')); ?>

    </button>
</div>
<div class="w-full text-center pb-8 ">

</div>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.js"></script>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.legacy.min.js" nomodule></script>
<script src="https://releases.transloadit.com/uppy/locales/v2.0.5/ru_RU.min.js"></script>
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
            target: '#file_basis',
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
            fieldName: 'file_basis',
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
            target: '#file_tech_spec',
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
            fieldName: 'file_tech_spec',
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
            target: '#other_files',
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
            fieldName: 'other_files',
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
<?php /**PATH E:\OpenServer\domains\laravel_voyager_uztelecom\resources\views/site/applications/form_edit.blade.php ENDPATH**/ ?>