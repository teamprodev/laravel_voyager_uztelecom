{{ Aire::open()
  ->route('warehouse.create')
  ->enctype("multipart/form-data")
  ->post() }}
<div class="mt-6">
    <div class="w-full flex">
        <div class="p-6">
            <div class="mb-3 row">
                <label class="col-sm-6" for="count" class="col-sm-2 col-form-label">Count</label>
                <div class="col-sm-6">
                    {{Aire::number()
                        ->name("count")
                        ->value($warehouse->count)
                        ->class("form-control")
                        ->required()
                    }}
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-6" for="purchase_basis" class="col-sm-2 col-form-label">Filial</label>
                <div class="col-sm-6">
                    {{Aire::select($branch, 'select2')
                    ->value($warehouse->branch_id)
                    ->name('branch_id')
                }}
                </div>
            </div>
            <input type="text" class="hidden" value="{{$application->id}}" name="application_id">
            <input type="text" class="hidden" value="{{$application->resource_id}}" name="product_id">
            @if(isset($application->resource_id))
                <b>{{ __('lang.resource')}}</b>:
                @foreach(json_decode($application->resource_id) as $product)
                    <br> {{\App\Models\Resource::find($product)->name}}
                @endforeach
            @endif
    </div>
</div>
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white">
        {{ __('lang.save_close') }}
    </button>
</div>
{{Aire::close()}}
