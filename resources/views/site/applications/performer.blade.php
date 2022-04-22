<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::select($branch, 'select', __('lang.performer_branch'))
                        ->name('branch_customer_id')
                        ->value($application->branch_customer_id)
                        }}
                    {{Aire::input('bio', __('lang.performer_lot'))
                        ->name('lot_number')
                        ->value($application->lot_number)
                    }}
                    {{Aire::input('bio', __('lang.performer_contract_num'))
                        ->name('contract_number')
                        ->value($application->contract_number)
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.performer_contract_date'))
                        ->name('contract_date')
                        ->value($application->contract_date)
                    }}
                    {{Aire::input()
                        ->value($application->contract_date)
                        ->disabled()
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.performer_protocol_date'))
                        ->name('protocol_date')
                        ->value($application->protocol_date)
                    }}
                    {{Aire::input()
                        ->value($application->protocol_date)
                        ->disabled()
                    }}
                    {{Aire::textArea('bio', __('lang.performer_contract_info'))
                        ->name('contract_info')
                        ->value($application->contract_info)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::checkbox('checkbox', __('lang.performer_nds'))
                       ->name('with_nds')
                    }}
                    {{Aire::select([1 => __('lang.tender'), 2 => __('lang.selection'), 3 => 'Eshop'], 'select', __('lang.table_19'))
                     ->value(1)
                     ->name('type_of_purchase_id')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::select($countries,'bio', __('performer_country'))
                        ->name('country_produced_id')
                        ->value($application->country_produced_id)
                    }}
                    {{Aire::input('bio', __('performer_price'))
                        ->name('contract_price')
                        ->value($application->contract_price)
                    }}

                    {{Aire::input('bio', __('performer_supplier'))
                        ->name('supplier_name')
                        ->value($application->supplier_name)
                    }}
                    {{Aire::input('bio', __('performer_inn'))
                        ->name('supplier_inn')
                        ->value($application->supplier_inn)
                    }}
                    {{Aire::textArea('bio', __('performer_info'))
                        ->name('product_info')
                        ->value($application->product_info)
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::input('bio', __('lang.performer_protocol_num'))
                        ->name('protocol_number')
                        ->value($application->protocol_number)
                    }}
                    {{Aire::input('bio', __('lang.performer_comment'))
                        ->name('performer_comment')
                        ->value($application->performer_comment)
                    }}
                    {{Aire::select([1 => __('lang.product'), 2 => __('lang.work'), 3 => __('lang.service')], 'select', __('lang.table_18'))
                     ->value(1)
                     ->name('subject')
                    }}
                    <input class="hidden" name="status" id="status" type="text">
                    <select class="col-md-6 custom-select" name="status" id="status">
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
    <input class="hidden" name="performer_user_id" id="performer_user_id" value="{{$user->id}}" type="text">
</div>


