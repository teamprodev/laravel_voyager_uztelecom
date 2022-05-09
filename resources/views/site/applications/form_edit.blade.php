<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="mb-3 row">
                <label class="col-sm-6" for="initiator" class="col-sm-2 col-form-label">{{ __('lang.table_1') }}</label>
                <div class="col-sm-6">
                    {{Aire::input()
                        ->name("initiator")
                        ->value($application->initiator)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="purchase_basis" class="col-sm-2 col-form-label">{{ __('lang.table_9') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("purchase_basis")
                        ->value($application->purchase_basis)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="basis" class="col-sm-2 col-form-label">{{ __('lang.table_11') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("basis")
                        ->value($application->basis)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="name" class="col-sm-2 col-form-label">{{ __('lang.table_2') }}</label>
                <div class="col-sm-6">
                    {{Aire::input()
                        ->name("name")
                        ->value($application->name)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="specification" class="col-sm-2 col-form-label">{{ __('lang.table_10') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("specification")
                        ->value($application->specification)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">{{ __('lang.table_3') }}</label>
                <div class="col-sm-6">
                    <input class="form-control" id="date" name="delivery_date" value="{{ $application->delivery_date }}" type="date"/>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="separate_requirements" class="col-sm-2 col-form-label">{{ __('lang.table_12') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("separate_requirements")
                        ->value($application->separate_requirements)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="other_requirements" class="col-sm-2 col-form-label">{{ __('lang.other') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("other_requirements")
                        ->value($application->other_requirements)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">{{ __('lang.table_14') }}</label>
                <div class="col-sm-6">
                    <input class="form-control" id="date" name="expire_warranty_date" value="{{$application->expire_warranty_date}}" type="date"/>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="planned_price" class="col-sm-2 col-form-label">{{ __('lang.table_4') }}</label>
                <div class="col-sm-6">
                    {{Aire::input()
                        ->name("planned_price")
                        ->id("planned_price")
                        ->value($application->planned_price)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="incoterms" class="col-sm-2 col-form-label">{{ __('lang.table_5') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("incoterms")
                        ->value($application->incoterms)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="info_business_plan" class="col-sm-2 col-form-label">{{ __('lang.table_15') }}</label>
                <div class="col-sm-6">
                    {{Aire::input()
                        ->name("info_business_plan")
                        ->value($application->info_business_plan)
                        ->class("form-control")
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="info_purchase_plan" class="col-sm-2 col-form-label">{{ __('lang.table_20') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("info_purchase_plan")
                        ->value($application->info_purchase_plan)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="comment" class="col-sm-2 col-form-label">{{ __('lang.table_23') }}</label>
                <div class="col-sm-6">
                    {{Aire::textArea()
                        ->rows(3)
                        ->name("comment")
                        ->value($application->comment)
                        ->cols(40)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="currency" class="col-sm-6 col-form-label">{{ __('lang.valyuta') }}</label>
                <select class="form-control col-sm-6" name="currency" id="currency">
                    <option value="UZS" @if($application->currency === "UZS") selected @endif>UZS</option>
                    <option value="USD" @if($application->currency === "USD") selected @endif>USD</option>
                </select>
            </div>

            <div class="mb-3 row">
                <label for="currency" class="col-sm-6 col-form-label">{{ __('lang.branch') }}</label>
                    {{Aire::select($branch, 'select')
                    ->name('branch_initiator_id')
                    ->value('branch_initiator_id')
                }}
                </select>
            </div>

            @if($application->is_more_than_limit !== 0 && $application->signers === null)
                {{Aire::select($company_signers, 'select2', __('lang.signers'))
                    ->name('signers')
                    ->multiple()
                }}
            @elseif($application->is_more_than_limit === 0 && $application->signers === null)
                {{Aire::select($branch_signers, 'select2', __('lang.signers'))
                    ->name('signers')
                    ->multiple()
                }}
            @endif
        </div>
        <div class="flex-direction: column">
            @if($application->file_basis === 'null' ||$application->file_basis === null)
                <div class="mx-1">
                    <h6 class="my-3">{{ __('lang.base') }}</h6>
                    <div id="file_basis"></div>
                </div>
            @endif
            @if($application->file_tech_spec === 'null' ||$application->file_tech_spec === null)
                <div class="mx-1">
                    <h6 class="my-3">{{ __('lang.tz') }}</h6>
                    <div id="file_tech_spec"></div>
                </div>
            @endif
            @if($application->other_files === 'null' ||$application->other_files === null)
                <div class="mx-1">
                    <h6 class="my-3">{{ __('lang.doc') }}</h6>
                    <div id="other_files"></div>
                </div>
            @endif
        </div>
    </div>
</div>
@if($application->resource_id === null)
    <input id="resource_id" name="resource_id" value=null class="hidden" type="text">
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
