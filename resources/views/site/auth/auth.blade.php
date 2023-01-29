<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.css" rel="stylesheet">
  <title>Uztelecom</title>
    @bukStyles
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
        .select2-selection__arrow {
            height: 38px !important;
        }
    </style>
</head>
<body>
@include('site.auth.navbar')
@bukScripts
<section class="bg-blueGray-50">

    <!--Modal-->
    <div class="w-full h-full flex items-center justify-center" style="height: 86vh;">

        <div class="bg-white w-11/12 mx-auto rounded shadow-lg z-50 overflow-y-auto" style="background-color: #0b2e13; max-width: 50%">
            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="py-2 text-left px-6" style="display: flex;flex-direction: column;height: 30em;justify-content: start;">

                <div class="flex justify-between items-center ">
                    <h5 style="margin: 4em auto;font-size: 1.6rem">Вход с помощью ЭЦП</h5>
                </div>
                <x-eimzo_login url="{{route('eri.login')}}"></x-eimzo_login>
            </div>
        </div>
    </div>

</section>
</body>
</html>
