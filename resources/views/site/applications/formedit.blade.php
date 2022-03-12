<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            {{Aire::textArea('bio','Ташаббускор (буюртмачи номи )')
                ->name('initiator')
                ->rows(3)
                ->cols(40)
                ->value($application->initiator)
            }}
            {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                ->name('purchase_basis')
                ->rows(3)
                ->cols(40)
                ->value($application->purchase_basis)
            }}
            {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                ->name('basis')
                ->rows(3)
                ->cols(40)
                ->value($application->basis)
            }}
            {{Aire::textArea('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                ->name('name')
                ->rows(3)
                ->cols(40)
                ->value($application->name)
            }}
            {{Aire::textArea('bio','Сотиб олинадиган махсулот тавсифи (техник характери)')
                ->name('specification')
                ->rows(3)
                ->cols(40)
                ->value($application->specification)
            }}
            {{Aire::input('bio','Махсулот келишининг муддати')
                ->name('delivery_date')
                ->value($application->delivery_date)
            }}
            {{Aire::textArea('bio','Алоҳида талаблар')
                ->name('separate_requirements')
                ->rows(3)
                ->cols(40)
                ->value($application->separate_requirements)
            }}
            {{Aire::textArea('bio','Махсулотга қўйилган бошқа талаблар (иш, хизмат)')
                ->name('other_requirements')
                ->rows(3)
                ->cols(40)
                ->value($application->other_requirements)
            }}
            {{Aire::input('bio','Махсулот сифати учун кафолат муддати (иш, хизмат)')
                ->name('expire_warranty_date')
                ->value($application->expire_warranty_date)
            }}
            {{Aire::textArea('bio','Харид режаси (сумма)')
                ->name('amount')
                ->rows(3)
                ->cols(40)
                ->value($application->amount)
            }}
            {{Aire::textArea('bio','Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)')
                ->name('incoterms')
                ->rows(3)
                ->cols(40)
                ->value($application->incoterms)
            }}
            {{Aire::textArea('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                ->name('budget_planning')
                ->rows(3)
                ->cols(40)
                ->value($application->budget_planning)
            }}
            {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                ->name('procurement_plan')
                ->rows(3)
                ->cols(40)
                ->value($application->procurement_plan)
            }}
            {{Aire::textArea('bio','Коментарий к заявке')
                ->name('comment')
                ->rows(3)
                ->cols(40)
                ->value($application->comment)
            }}
            <div id="aa">
                <h4 class="text-center">Прикрепить файл</h4>
            @if($application->file_basis == 'null')
                <h6>Основание</h6>
                <div id="file_basis"></div>
                @endif
                @if($application->file_tech_spec == 'null')
                <h6>Техническое задание</h6>
                <div id="file_tech_spec"></div>
                @endif
                @if($application->other_files == 'null')
                <h6>Другие документы необходимые для запуска закупочной процедуры</h6>
                <div id="other_files"></div>
                @endif
            </div>
        </div>
    </div>
</div>
{{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
<div class="w-full text-right py-4 pr-10">
    <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
    <button type="submit" class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">Сохранить и отправить</button>
</div>
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
        locale: {},
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
            width: 400,
            height: 200,
            metaFields: [
                {id: 'name', name: 'Name', placeholder: 'file name'},
                {id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'}
            ],
            browserBackButtonClose: true
        })
        .use(Uppy.XHRUpload, {
            endpoint: '{{route('uploadImage', $application->id)}}',
            formData: true,
            fieldName: 'file_basis',
            headers: file => ({
                'X-CSRF-TOKEN': '{{csrf_token()}}'
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
        locale: {},
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
            width: 400,
            height: 200,
            metaFields: [
                {id: 'name', name: 'Name', placeholder: 'file name'},
                {id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'}
            ],
            browserBackButtonClose: true
        })
        .use(Uppy.XHRUpload, {
            endpoint: '{{route('uploadImage', $application->id)}}',
            formData: true,
            fieldName: 'file_tech_spec',
            headers: file => ({
                'X-CSRF-TOKEN': '{{csrf_token()}}'
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
        locale: {},
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
            width: 400,
            height: 200,
            metaFields: [
                {id: 'name', name: 'Name', placeholder: 'file name'},
                {id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'}
            ],
            browserBackButtonClose: true
        })
        .use(Uppy.XHRUpload, {
            endpoint: '{{route('uploadImage', $application->id)}}',
            formData: true,
            fieldName: 'other_files',
            headers: file => ({
                'X-CSRF-TOKEN': '{{csrf_token()}}'
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
