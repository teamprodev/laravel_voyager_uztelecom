<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="flex items-baseline">
                <div class="mr-4 pt-2 pb-2 w-50">
                        {{Aire::number('num', "Number Application")
                            ->name('number')
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


