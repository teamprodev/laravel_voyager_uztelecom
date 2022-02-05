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
                <li class="bg-white text-3xl px-12 text-gray-800 font-semibold hover:bg-gray-200 py-2 text-blue-600 border-b-2 border-blue-600"><a id="default-tab" href="#first">Register</a></li>
                <li class="px-12 text-3xl text-gray-800 hover:bg-gray-200 font-semibold py-2"><a href="#second">Login</a></li>
            </ul>
          </div>
      
        <!-- Tab Contents -->
        <div id="tab-contents" class="flex justify-center">
          <div id="first" class="p-4">
            <div class="w-96">
                <div>
                    <label class="block text-sm">
                        Name
                    </label>
                    <input type="text"
                        class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                        placeholder="Name" />
                </div>
                <div class="mt-4">
                    <label class="block text-sm">
                        Email Adress
                    </label>
                    <input type="email"
                        class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                        placeholder="Email Address" />
                </div>
                <div>
                    <label class="block mt-4 text-sm">
                        Password
                    </label>
                    <input
                        class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                        placeholder="Password" type="password" />
                </div>
                <div>
                    <label class="block mt-4 text-sm">
                    Confirm Password
                    </label>
                    <input class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600" placeholder="Password" type="password" />
                </div>
                <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Register
                </button>
            </div>
          </div>
  
          <div id="second" class="hidden p-4">
            <div class="w-96">
                <div class="mt-4">
                <label class="block text-sm">
                    Email Adress
                </label>
                <input type="email"
                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    placeholder="Email Address" />
                </div>
                <div>
                <label class="block mt-4 text-sm">
                    Password
                </label>
                <input
                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    placeholder="Password" type="password" />
                </div>
                <div class="flex items-center mt-4">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
                </div>
                <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Login
                </button>
                <div class="mt-4">
                    <a href="#" class="text-lg text-center text-gray-700 hover:text-red-500">Forgot your Password?</a>
                </div>
            </div>
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
