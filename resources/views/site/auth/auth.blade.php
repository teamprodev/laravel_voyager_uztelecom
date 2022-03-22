<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.css" rel="stylesheet">
  <title>Uztelecom</title>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">


</head>
<body>



<div id="second" class="p-4 {{\Route::currentRouteName()=="login" ? '' : "hidden" }}">
    @include('site.auth.login')

</div>

<script src="{{ asset('assets/js/eimzo/e-imzo.js') }}"></script>
<script src="{{ asset('assets/js/eimzo/e-imzo-client.js') }}"></script>
<script src="{{ asset('assets/js/eimzo/imzo.js') }}"></script>
</body>
</html>
