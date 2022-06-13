@extends('voyager::master')
@section('content')
    <div class="container mt-5" style="max-width: 550px">
        <div class="res-msg mt-3 mb-3" style="display: none;">
            <div class="alert alert-success"></div>
        </div>
            <div class="mb-3">
                @if($add_signers != '[]')
                {{Aire::select($add_signers, 'select2', 'Add Signers')
                ->multiple()
                ->name("add_signers[]")
                ->class("add_signers")
                ->value(json_decode($branch->add_signers))}}
                @endif
                @if($signers != '[]')
                {{Aire::select($signers, 'select2', 'Signers')
                ->multiple()
                ->name("signers[]")
                ->class("signers")
                ->value(json_decode($branch->signers))}}
                @endif
            </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.add_signers').select2();
            $('.signers').select2();
        });
    </script>
@endsection
