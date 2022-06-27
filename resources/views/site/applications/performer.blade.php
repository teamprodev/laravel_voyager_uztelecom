@if($application->performer_role_id == auth()->user()->role_id)
<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($branch, 'select', __('Филиал заказчик по контракту'))
                        ->name('branch_customer_id')
                        ->value($application->branch_customer_id)
                        }}
                    {{Aire::input('bio', __('Номер лота'))
                        ->name('lot_number')
                        ->value($application->lot_number)
                    }}
                    {{Aire::input('bio', __('Номер договора'))
                        ->name('contract_number')
                        ->value($application->contract_number)
                    }}.
                    {{Aire::date('date_input', __('Дата договора'))
                        ->name('contract_date')
                        ->value($application->contract_date)
                    }}
                    {{Aire::date('bio', __('Дата протокола'))
                        ->name('protocol_date')
                        ->value($application->protocol_date)
                    }}
                    {{Aire::input('bio', __('Номер протокола'))
                        ->name('protocol_number')
                        ->value($application->protocol_number)
                    }}
                    {{Aire::textArea('bio', __('Предмет договора (контракта) и краткая характеристика'))
                        ->name('contract_info')
                        ->value($application->contract_info)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::checkbox('checkbox', __('С НДС'))
                       ->name('with_nds')
                    }}
                    {{Aire::input('bio', __('Общая реальная сумма'))
                        ->name('contract_price')
                        ->value($application->contract_price)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($countries,'bio', __('Товары (обслуживание) страна изготовленной'))
                        ->name('country_produced_id')
                        ->value($application->country_produced_id)
                    }}


                    {{Aire::input('bio', __('Наименование поставщика'))
                        ->name('supplier_name')
                        ->value($application->supplier_name)
                    }}
                    {{Aire::input('bio', __('Поставщик Перемешать номер'))
                        ->name('supplier_inn')
                        ->value($application->supplier_inn)
                    }}
                    {{Aire::textArea('bio', __('Информация о товаре'))
                        ->name('product_info')
                        ->value($application->product_info)
                        ->rows(3)
                        ->cols(40)
                    }}

                    <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::select($subject, 'select', __('Предмет закупки'))
                            ->name('subject')
                            ->value($application->subject)
                        }}
                    </div>
                    <div class="pt-2 pb-2 w-50">
                        {{Aire::select($purchase, 'select', __('Вид закупки'))
                            ->name('type_of_purchase_id')
                            ->value($application->type_of_purchase_id)
                        }}
                    </div>
                    {{Aire::select($status_extented, 'select')
                        ->name('status')
                        ->name('status')
                        ->value($application->status)
                        }}
                    <div id="file"></div>
                    <div id="a" class="hidden mb-3">
                        <label for="message-text" class="col-form-label">{{ __('Комментарий') }}:</label>
                        <input class="form-control" name="report_if_cancelled" id="report_if_cancelled">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
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
                endpoint: '{{route('uploadImage', $application->id)}}',
                formData: true,
                fieldName: 'performer_file',
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
</div>
@else
    <h3 style="text-align:center;color:red;">{{ __('Руководство не выбрало вас') }}</h3>
@endif

