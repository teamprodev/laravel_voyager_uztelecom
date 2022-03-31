<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Ташаббускор (буюртмачи номи )')
                        ->name('initiator')
                        ->value($application->initiator)
                    }}
                    {{Aire::textArea('bio','Харид мазмуни (сотиб олиш учун асос)')
                        ->name('purchase_basis')
                        ->value($application->purchase_basis)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio','Сотиб олинадиган махсулот тавсифи (техник характери)')
                        ->name('specification')
                        ->value($application->specification)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio','Махсулот келишининг муддати')
                        ->name('delivery_date')
                        ->value($application->delivery_date)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio','Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)')
                        ->name('name')
                        ->value($application->name)
                    }}
                    {{Aire::textArea('bio','Асос (харидлар режаси, раҳбарият томонидан билдирги)')
                        ->name('basis')
                        ->value($application->basis)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio','Алоҳида талаблар')
                        ->name('separate_requirements')
                        ->value($application->separate_requirements)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio','Махсулот сифати учун кафолат муддати (иш, хизмат)')
                        ->name('expire_warranty_date')
                        ->value($application->expire_warranty_date)
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Харид режаси (сумма)')
                        ->name('planned_price')
                        ->value($application->planned_price)
                        ->id('summa')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio','Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                        ->name('info_business_plan')
                        ->value($application->info_business_plan)
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio','Эквивалентная Планируемая сумма')
                        ->name('equal_planned_price')
                        ->value($application->equal_planned_price)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        <h6><b>Филиални танланг</b></h6>
                        <select class="custom-select" name="filial_initiator_id" id="filial_initiator_id">
                            @isset($application->filial_initiator_id)
                                <option value="{{$application->filial_initiator_id}}" selected>{{$application->filial_initiator_id}}</option>
                            @endisset
                            @foreach($branchAll as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($purchase, 'select', 'Предмет закупки')
                        ->name('subject')
                        ->value($application->subject)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($subject, 'select', 'Вид закупки')
                        ->name('type_of_purchase_id')
                        ->value($application->type_of_purchase_id)
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio','Харид килинадиган махсулотни "Харидлар режаси"да мавжудлиги буйича маълумот')
                        ->name('info_purchase_plan')
                        ->value($application->info_purchase_plan)
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio','Коментарий к заявке')
                        ->name('comment')
                        ->value($application->comment)
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
            </div>
            <div class="w-full">
                @if($application->signers == null)
                    {{Aire::select($roles, 'signers', 'Multi-Select')
                                        ->multiple()
                                        }}
                @endif
            </div>
        </div>
    </div>
</div>
@if(!isset($application->performer_user_id))
    <select class="col-md-6 custom-select" name="performer_user_id" id="performer_user_id">
        @php
            $users = \App\Models\Permission::with('roles.users')->where('key', 'Company_Performer')->first()->roles->map->users; // company performer
        @endphp
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
@endif
<div class="grid grid-cols-2 px-6">
    @if($application->file_basis == 'null' ||$application->file_basis == null)
        <div>
            <h6 class="my-3">Основание</h6>
            <div id="file_basis"></div>
        </div>
    @endif
    @if($application->file_tech_spec == 'null' ||$application->file_tech_spec == null)
        <div>
            <h6 class="my-3">Техническое задание</h6>
            <div id="file_tech_spec"></div>
        </div>
    @endif
    @if($application->other_files == 'null' ||$application->other_files == null)
        <div>
            <h6 class="my-3">Другие документы необходимые для запуска закупочной процедуры</h6>
            <div id="other_files"></div>
        </div>
    @endif
</div>

{{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Сохранить и закрыть</button>
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
