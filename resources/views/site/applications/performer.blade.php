<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select([  ], 'select', 'Филиал заказчик по контракту')
                        ->name('filial_customer_id')
                        }}
                    {{Aire::input('bio','Номер лота')
                        ->name('lot_number')
                    }}
                    {{Aire::input('bio','Номер договора')
                        ->name('contract_number')
                    }}
                    {{Aire::dateTimeLocal('bio','Дата договора')
                        ->name('contract_date')
                    }}
                    {{Aire::dateTimeLocal('bio','Дата протокола')
                        ->name('protocol_date')
                    }}

                    {{Aire::textArea('bio','Предмет договора (контракта) и краткая характеристика')
                        ->name('contract_info')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::checkbox('checkbox', 'С ндс')
                       ->name('with_nds')
                    }}

                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio','Страна происхождения товаров (услуг)')
                        ->name('country_produced_id')
                    }}
                    {{Aire::input('bio','Итоговая реальная сумма')
                        ->name('contract_price')
                    }}

                    {{Aire::input('bio','Наименование поставщика')
                        ->name('supplier_name')
                    }}
                    {{Aire::input('bio','ИНН поставщика')
                        ->name('supplier_inn')
                    }}
                    {{Aire::textArea('bio','Информация о продукте')
                        ->name('product_info')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::input('bio','Номер протокола')
                        ->name('protocol_number')
                    }}
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button id="status1" value="performed" onclick="status11()" type="submit" class="btn btn-success col-md-2" >Performed</button>
        <button id="status0" value="cancelled" onclick="status00()" type="submit" class="btn btn-danger col-md-2 mx-2   " >Cancelled</button>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
<script>
    function status11()
    {
        $.ajax({
            url: "{{ route('site.applications.ajax') }}",
            method: "POST",
            data:{
                _token: '{{ csrf_token() }}',
                status: document.getElementById('status1').value,
                application_id: {{$application->id}}
            },
            success: function() {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Performed',
            showConfirmButton: false,
            timer: 1000
        })
    }
    function status00()
    {
        $.ajax({
            url: "{{ route('site.applications.ajax') }}",
            method: "POST",
            data:{
                _token: '{{ csrf_token() }}',
                status: document.getElementById('status0').value,
                application_id: {{$application->id}}
            },
            success: function() {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Cancelled',
            showConfirmButton: false,
            timer: 1000
        })
    }
</script>


