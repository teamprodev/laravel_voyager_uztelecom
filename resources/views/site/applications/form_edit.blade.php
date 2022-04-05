<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_1'))
                        ->name('initiator')
                        ->value($application->initiator)
                    }}
                    {{Aire::textArea('bio', __('lang.table_9'))
                        ->name('purchase_basis')
                        ->value($application->purchase_basis)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio', __('lang.table_10'))
                        ->name('specification')
                        ->value($application->specification)
                        ->rows(3)
                        ->cols(40)
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
                    }}
                    {{Aire::textArea('bio', __('lang.table_11'))
                        ->name('basis')
                        ->value($application->basis)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio', __('lang.table_12'))
                        ->name('separate_requirements')
                        ->value($application->separate_requirements)
                        ->rows(3)
                        ->cols(40)
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
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_15'))
                        ->name('info_business_plan')
                        ->value($application->info_business_plan)
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    @if($application->currency == null)
                    {{Aire::select(['USD' => 'USD', "SO'M" => "SO'M"], 'select', __('lang.valyuta'))
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
                                <option value="{{$application->branch_initiator_id}}" selected>{{$application->branch_initiator_id}}</option>
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
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_20'))
                        ->name('info_purchase_plan')
                        ->value($application->info_purchase_plan)
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_23'))
                        ->name('comment')
                        ->value($application->comment)
                        ->rows(3)
                        ->cols(40)
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
<table id="tblAppendGrid"></table>

<script src="https://unpkg.com/jquery.appendgrid@2.0.0/dist/AppendGrid.js"></script>
<script>
    var myAppendGrid = new AppendGrid({
        element: "tblAppendGrid",
        uiFramework: "bootstrap4",
        iconFramework: "fontawesome5",
        columns: [
            {
                name: "company",
                display: "Company"
            },
            {
                name: "name",
                display: "Contact Person"
            },
            {
                name: "country",
                display: "Country",
                type: "select",
                ctrlOptions: [
                    "",
                    "Germany",
                    "Hong Kong",
                    "Japan",
                    "Malaysia",
                    "Taiwan",
                    "United Kingdom",
                    "United States"
                ]
            },
            {
                name: "isNPO",
                display: "NPO?",
                type: "checkbox",
                cellClass: "text-center"
            },
            {
                name: "orderPlaced",
                display: "Order Placed",
                type: "number",
                ctrlAttr: {
                    min: 0,
                    max: 10000
                }
            },
            {
                name: "memberSince",
                display: "Member Since",
                type: "date",
                ctrlAttr: {
                    maxlength: 10
                }
            },
            {
                name: "uid",
                type: "hidden",
                value: "0"
            }
        ],
        // Optional CSS classes, to make table slimmer!
        sectionClasses: {
            table: "table-sm",
            control: "form-control-sm",
            buttonGroup: "btn-group-sm"
        }
    });
    $("#load").on("click", function () {
        myAppendGrid.load([
            {
                uid: "d4c74a61-a24e-429f-9db0-3cf3aaa22425",
                name: "Monique Zebedee",
                company: "Welch LLC",
                country: "Japan",
                memberSince: "2012-02-18",
                orderPlaced: 111,
                level: "Bronze",
                isNPO: true
            },
            {
                uid: "afdf285d-da5c-4fa8-9225-201c858a173d",
                name: "Daryle McLaren",
                company: "Bogisich Group",
                country: "United States",
                memberSince: "2016-10-08",
                orderPlaced: 261,
                level: "Diamond",
                isNPO: false
            },
            {
                uid: "202a8afb-130b-476b-b415-c659f21a73e7",
                name: "Glori Spellecy",
                company: "Grady and Sons",
                country: "Germany",
                memberSince: "2014-07-28",
                orderPlaced: 282,
                level: "Gold",
                isNPO: false
            },
            {
                uid: "08c9adee-abdd-43d5-866d-ce540be19be8",
                name: "Blondy Boggis",
                company: "Eichmann, Parker and Herzog",
                country: "Malaysia",
                memberSince: "2010-08-17",
                orderPlaced: 308,
                level: "Platinum",
                isNPO: true
            },
            {
                uid: "57644023-cd0c-47ec-a556-fd8d4e21a4e7",
                name: "Batholomew Zecchii",
                company: "Corwin-Fahey",
                country: "Malaysia",
                memberSince: "2016-09-20",
                orderPlaced: 881,
                level: "Gold",
                isNPO: true
            },
            {
                uid: "38e08e8a-c7eb-41eb-9191-6bb2df1fd39b",
                name: "Paulie Poel",
                company: "MacGyver, Rohan and West",
                country: "United Kingdom",
                memberSince: "2016-12-26",
                orderPlaced: 387,
                level: "Silver",
                isNPO: false
            },
            {
                uid: "d7bf56d4-f955-4dca-b3db-b30eab590028",
                name: "Jessica Levett",
                company: "Lind, O'Kon and Hamill",
                country: "United States",
                memberSince: "2015-04-26",
                orderPlaced: 984,
                level: "Gold",
                isNPO: false
            },
            {
                uid: "b9075764-5228-4ca7-9435-7c362ce097e5",
                name: "Fonsie Spring",
                company: "McKenzie, Block and Wiegand",
                country: "Japan",
                memberSince: "2013-11-08",
                orderPlaced: 875,
                level: "Silver",
                isNPO: false
            }
        ]);
    });
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
        <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white"
                name="draft" value="0">
            {{ __('lang.save_send') }}
        </button>
    </div>
    <div class="w-full text-center pb-8 ">

    </div>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.js"></script>
<script src="https://releases.transloadit.com/uppy/v2.4.1/uppy.legacy.min.js" nomodule></script>
<script src="https://releases.transloadit.com/uppy/locales/v2.0.5/ru_RU.min.js"></script>
@if($application->is_more_than_limit == null)
<input id="is_more_than_limit" class="hidden">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmSubmitText: 'Confirm',
        cancelSubmitText: 'Cancel',
        confirmSubmitClass: 'button is-success has-right-spacing',
        cancelSubmitClass: 'button is-danger',
    }).then((result) => {
        if(result.isConfirmed == true)
        {
            document.getElementById('is_more_than_limit').value = 1;
            ajax();
        } else if (result.isDenied) {
            document.getElementById('is_more_than_limit').value = 0;
            ajax();
        }
    })

    function ajax()
    {
        $.ajax({
            url: "{{ route('site.applications.update', $application->id) }}",
            method: "POST",
            data:{
                _token: '{{ csrf_token() }}',
                is_more_than_limit: document.getElementById('is_more_than_limit').value,
            },
            success: function()
            {
                location.reload()
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
