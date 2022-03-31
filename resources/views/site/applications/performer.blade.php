<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($branch, 'select', 'Филиал заказчик по контракту')
                        ->name('branch_customer_id')
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
                    {{Aire::select($countries,'bio','Страна происхождения товаров (услуг)')
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
        <input class="hidden" name="status" id="status" type="text">
        <button  onclick="status11()" type="submit" class="btn btn-success col-md-2">Performed</button>
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger col-md-2 mx-2">Cancelled</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Коментария:</label>
                            <input class="form-control" name="report_if_cancelled" id="report_if_cancelled">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="status00()" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
<script>
    function status11()
    {
        document.getElementById('status').value = 'performed';
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
         document.getElementById('status').value = 'cancelled';
8    }
</script>


