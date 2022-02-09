<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.css" rel="stylesheet">
  <title>Uztelecom</title>
</head>
<body>


        <!-- Tabs -->
        <div class="mx-auto my-12 ">
            <ul id="tabs" class="nav nav-tabs flex  text-center flex-wrap list-none border-b-0 pl-0 mb-4 justify-center">
                <li class="bg-white text-3xl px-12 text-gray-800 font-semibold hover:bg-gray-200 py-2  {{\Route::currentRouteName()=="login" ? '' :"text-blue-600 border-b-2 border-blue-600" }}"><a id="default-tab" href="#first">Register</a></li>
                <li class="px-12 text-3xl text-gray-800 hover:bg-gray-200 font-semibold py-2 {{\Route::currentRouteName()=="register" ? '' : "text-blue-600 border-b-2 border-blue-600" }}"><a href="#second">Login</a></li>
            </ul>
          </div>

        <!-- Tab Contents -->
        <div id="tab-contents" class="flex justify-center">
          <div id="first" class="p-4 {{\Route::currentRouteName()=="register" ? '' : "hidden" }}">
              @include('site.auth.register')
          </div>
          <div id="second" class="p-4 {{\Route::currentRouteName()=="login" ? '' : "hidden" }}">
              @include('site.auth.login')

          </div>
        </div>
    <script>
        let tabsContainer = document.querySelector("#tabs");
        let tabTogglers = tabsContainer.querySelectorAll("#tabs a");
        console.log(tabTogglers);
        tabTogglers.forEach(function(toggler) {
        toggler.addEventListener("click", function(e) {
        e.preventDefault();
        let tabName = this.getAttribute("href");
        let tabContents = document.querySelector("#tab-contents");
        for (let i = 0; i < tabContents.children.length; i++) {
        tabTogglers[i].parentElement.classList.remove(  "text-blue-600","border-b-2","border-blue-600");
        tabContents.children[i].classList.remove("hidden");
        if ("#" + tabContents.children[i].id === tabName) {
            continue;
        }
        tabContents.children[i].classList.add("hidden");
        }
        e.target.parentElement.classList.add( "text-blue-600","border-b-2","border-blue-600");
        });
        });
    </script>
</body>
</html>
