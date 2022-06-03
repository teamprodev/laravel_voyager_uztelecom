@extends('voyager::master')
@section('content')
    {{ Aire::open()
    ->route('signers.update',$branch->id)
    ->enctype("multipart/form-data")
    ->post() }}
    {{Aire::checkboxGroup($add_signers, 'radio', __('lang.signers'))
                    ->name('add_signers[]')
                    ->value(json_decode($branch->add_signers))
                    ->multiple()
                }}
    {{Aire::checkboxGroup($signers, 'radio')
                    ->name('signers[]')
                    ->value(json_decode($branch->signers))
                    ->multiple()
                }}
    <button class="bg-blue-500 hover:bg-blue-700 mx-4 p-2 transition duration-300 rounded-md text-white">
        Update
    </button>
    {{Aire::close()}}
@endsection
