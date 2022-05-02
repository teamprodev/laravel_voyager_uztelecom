<div class="pt-6">
    <div class="w-full flex">
        <div class="p-6">
                        {{Aire::number('num', "Number Application")
                            ->name('number')
                             }}
                             <div class="mb-3 row">
                                <label class="col-sm-6" for="date" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="date" name="date" type="date" value="{{$application->date}}"/>
                                </div>
                            </div>      
        </div>
    </div>

    <div class="row ml-4 pb-4">
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </div>
</div>


