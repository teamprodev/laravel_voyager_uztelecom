<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', __('lang.table_20'))
                        ->name('info_purchase_plan')
                        ->value($application->info_purchase_plan)
                        ->rows(3)
                        ->cols(40)
                    }}
                    @if($user->hasPermission('Number_Change'))
                    {{Aire::number('num', "Number Application")
                        ->name('number')
                         }}
                         <div class="mb-3 row">
                                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="date" name="date" type="date"/>
                                </div>
                            </div>
                    @endif
                </div>
                <div class="pt-2 pb-2 w-50">
                    {{Aire::textArea('bio', 'Бюджетни режалаштириш бўлими - харид қилинадиган махсулотни бизнес режада мавжудлиги бўйича маълумот')
                        ->name('budget_planning')
                        ->value($application->budget_planning)
                        ->rows(3)
                        ->cols(40)
                    }}
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </div>
 </div>


