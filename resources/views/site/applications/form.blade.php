<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_1'))
                        ->name('initiator')
                    }}
                    {{Aire::textArea('bio', __('lang.table_9'))
                        ->name('purchase_basis')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio', __('lang.table_10'))
                        ->name('specification')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio', __('lang.table_3'))
                        ->name('delivery_date')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_2'))
                        ->name('name')
                    }}
                    {{Aire::textArea('bio', __('lang.table_11'))
                        ->name('basis')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::textArea('bio', __('lang.table_12'))
                        ->name('separate_requirements')
                        ->rows(3)
                        ->cols(40)
                    }}
                    {{Aire::dateTimeLocal('bio',  __('lang.table_14'))
                        ->name('expire_warranty_date')
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_4'))
                        ->name('planned_price')
                        ->id('summa')
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_15'))
                        ->name('info_business_plan')
                    }}
                </div>

            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::input('bio', __('lang.table_16'))
                        ->name('equal_planned_price')
                    }}
                </div>
            </div>
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_20'))
                        ->name('info_purchase_plan')
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_21'))
                        ->name('comment')
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
            </div>
        </div>
    </div>
    {{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
    <div class="w-full text-right py-4 pr-10">
        <button type="submit"
        class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">
            {{ __('lang.save_send') }}
        </button>
        <button type="submit"
                class="bg-green-500 hover:bg-green-700 p-2 transition duration-300 rounded-md text-white">
            {{ __('lang.save_close') }}
        </button>

    </div>
</div>
