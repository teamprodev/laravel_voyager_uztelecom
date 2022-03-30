@extends('site.layouts.app')

@section('center_content')
    <div class="p-4">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    {{Aire::open()
  ->route('site.applications.update',$application->id)
 }}
    @if($application->is_more_than_limit != 0)
        <div class="w-full">

            {{Aire::select($company_signers, 'signers', 'Multi-Select')
                                            ->multiple()
                                            ->id('signers')
                                            ->size(10)
                                            }}
        </div>
    @else
        <div class="w-full">
            {{Aire::select($branch_signers, 'signers', 'Multi-Select')
                                            ->multiple()
                                            ->id('signers')
                                            ->size(10)
                                            }}
        </div>
    @endif
    {{Aire::submit('Сохранить')}}
    {{Aire::close()}}
    <script>
        function functionBack()
        {
            window.history.back();
        }
    </script>

@endsection

