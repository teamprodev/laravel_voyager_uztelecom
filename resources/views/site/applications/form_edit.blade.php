<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_1'))
                        ->name('initiator')
                        ->value($application->initiator)
                        ->required()
                    }}
                    {{Aire::textArea('bio', __('lang.table_9'))
                        ->name('purchase_basis')
                        ->value($application->purchase_basis)
                        ->rows(3)
                        ->cols(40)
                        ->required()
                    }}
                    {{Aire::textArea('bio', __('lang.table_10'))
                        ->name('specification')
                        ->value($application->specification)
                        ->rows(3)
                        ->cols(40)
                        ->required()
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.table_3'))
                        ->name('delivery_date')
                        ->value($application->delivery_date)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_2'))
                        ->name('name')
                        ->value($application->name)
                        ->required()
                    }}
                    {{Aire::textArea('bio', __('lang.table_11'))
                        ->name('basis')
                        ->value($application->basis)
                        ->rows(3)
                        ->cols(40)
                        ->required()
                    }}
                    {{Aire::textArea('bio', __('lang.table_12'))
                        ->name('separate_requirements')
                        ->value($application->separate_requirements)
                        ->rows(3)
                        ->cols(40)
                        ->required()
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.table_14'))
                        ->name('expire_warranty_date')
                        ->value($application->expire_warranty_date)
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_4'))
                        ->name('planned_price')
                        ->value($application->planned_price)
                        ->id('planned_price')
                        ->required()
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_15'))
                        ->name('info_business_plan')
                        ->value($application->info_business_plan)
                        ->required()
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    @if($application->currency == null)
                        {{Aire::select(["SO'M" => "SO'M", 'USD' => 'USD'], 'select', __('lang.valyuta'))
                            ->name('currency')
                            ->id('currency')
                        }}
                    @endif
                </div>
                <div class="pt-2 pb-2 w-50">
                    <div class="mr-4 pt-2 pb-2 w-50">
                        <h6><b>{{ __('lang.branch') }}</b></h6>
                        <select class="custom-select" name="filial_initiator_id" id="filial_initiator_id">
                            @isset($application->branch_initiator_id)
                                <option value="{{$application->branch_initiator_id}}"
                                        selected>{{$application->branch_initiator_id}}</option>
                            @endisset
                            @foreach($branch as $branches)
                                <option value="{{$branches}}">{{$branches}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($purchase, 'select', __('lang.table_18'))
                        ->name('subject')
                        ->value($application->subject)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($subject, 'select', __('lang.table_19'))
                        ->name('type_of_purchase_id')
                        ->value($application->type_of_purchase_id)
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_23'))
                        ->name('comment')
                        ->value($application->comment)
                        ->rows(3)
                        ->cols(40)
                        ->required()
                    }}
                    @if($application->is_more_than_limit != 0)
                        <div class="w-full">

                            {{Aire::select($company_signers, 'signers', __('lang.signers'))
                                ->multiple()
                                ->id('signers')
                                ->size(10)
                            }}
                        </div>
                    @else
                        <div class="w-full">
                            {{Aire::select($branch_signers, 'signers', __('lang.signers'))
                                ->multiple()
                                ->id('signers')
                                ->size(10)
                            }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<input id="resource_id" name="resource_id" value=null class="hidden" type="text">
@if($application->resource_id == null)
<table id="table"></table>
@endif
<script src="https://unpkg.com/jquery.appendgrid@2.0.0/dist/AppendGrid.js"></script>
{{--@dd(json_encode($products,JSON_UNESCAPED_UNICODE))--}}
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
                ctrlOptions: {!! json_encode($products,JSON_UNESCAPED_UNICODE)!!},
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
<div class="grid grid-cols-2 px-6">
    @if($application->file_basis == 'null' ||$application->file_basis == null)
        <div>
            <h6 class="my-3">{{ __('lang.base') }}</h6>
            <div id="file_basis"></div>
        </div>
    @endif
    @if($application->file_tech_spec == 'null' ||$application->file_tech_spec == null)
        <div>
            <h6 class="my-3">{{ __('lang.tz') }}</h6>
            <div id="file_tech_spec"></div>
        </div>
    @endif
    @if($application->other_files == 'null' ||$application->other_files == null)
        <div>
            <h6 class="my-3">{{ __('lang.doc') }}</h6>
            <div id="other_files"></div>
        </div>
    @endif
</div>
{{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
            name="draft" value="1">
        {{ __('lang.save_close') }}
    </button>
    <button onclick="functionMy()" class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
            name="draft" value="0">
        {{ __('lang.save_send') }}
    </button>
</div>
<div class="w-full text-center pb-8 ">

</div>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.js"></script>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.legacy.min.js" nomodule></script>
<script src="https://releases.transloadit.com/uppy/locales/v2.0.5/ru_RU.min.js"></script>
@if($application->is_more_than_limit != '1' && $application->is_more_than_limit != '0')
    <input id="is_more_than_limit" class="hidden">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Визирование заявки через компанию',
            showDenyButton: true,
            showCancelButton: true,
            confirmSubmitText: 'Confirm',
            cancelSubmitText: 'Cancel',
            confirmSubmitClass: 'button is-success has-right-spacing',
            cancelSubmitClass: 'button is-danger',
        }).then((result) => {
            if (result.isConfirmed == true) {
                document.getElementById('is_more_than_limit').value = 1;
                ajax();
            } else if (result.isDenied == true) {
                document.getElementById('is_more_than_limit').value = 0;
                ajax();
            }
        })

        function ajax() {
            $.ajax({
                url: "{{ route('site.applications.update', $application->id) }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    is_more_than_limit: document.getElementById('is_more_than_limit').value,
                },
                success: function () {
                    location.reload();
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        }
    </script>
@endif
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
