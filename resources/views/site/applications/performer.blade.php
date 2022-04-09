<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($branch, 'select', __('lang.performer_branch'))
                        ->name('branch_customer_id')
                        }}
                    {{Aire::input('bio', __('lang.performer_lot'))
                        ->name('lot_number')
                    }}
                    {{Aire::input('bio', __('lang.performer_contract_num'))
                        ->name('contract_number')
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.performer_contract_date'))
                        ->name('contract_date')
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.performer_protocol_date'))
                        ->name('protocol_date')
                    }}

                    {{Aire::textArea('bio', __('lang.performer_contract_info'))
                        ->name('contract_info')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::checkbox('checkbox', __('lang.performer_nds'))
                       ->name('with_nds')
                    }}

                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($countries,'bio', __('performer_country'))
                        ->name('country_produced_id')
                    }}
                    {{Aire::input('bio', __('performer_price'))
                        ->name('contract_price')
                    }}

                    {{Aire::input('bio', __('performer_supplier'))
                        ->name('supplier_name')
                    }}
                    {{Aire::input('bio', __('performer_inn'))
                        ->name('supplier_inn')
                    }}
                    {{Aire::textArea('bio', __('performer_info'))
                        ->name('product_info')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::input('bio', __('lang.performer_protocol_num'))
                        ->name('protocol_number')
                    }}
                    {{Aire::textArea('bio', 'Comment Performer Leader')
                        ->name('performer_leader_comment')
                        ->value($application->performer_leader_comment)
                        ->rows(3)
                        ->cols(40)
                        ->disabled()
                    }}
                    <input class="hidden" name="status" id="status" type="text">
                    <select onchange="myFunction()" class="col-md-6 custom-select" name="performer_status" id="performer_status">
                        @foreach($status_extented as $status)
                        <option value="{{$status->name}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                    <div id="a" class="hidden mb-3">
                        <label for="message-text" class="col-form-label">{{ __('lang.table_23') }}:</label>
                        <input class="form-control" name="report_if_cancelled" id="report_if_cancelled">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
<script>
    function myFunction()
    {
        if (document.getElementById('performer_status').value != 'Отменен')
        {
            document.getElementById('a').classList.add('hidden');

        }else if(document.getElementById('performer_status').value == 'доставлен')
        {
            document.getElementById('status').value = 'performed';
        }else{
            document.getElementById('a').classList.remove('hidden');
            document.getElementById('status').value = 'cancelled';
    }

    }
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
</script>


