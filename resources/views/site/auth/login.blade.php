
<section class="bg-blueGray-50">
    <div class="w-2/12 mx-auto">
        <a href="/">
            <img src="{{ asset('images/Uztelecom_Logo.png') }}" alt="">
        </a>
    </div>
    <div class="w-full lg:w-4/12 px-4 mx-auto pt-6">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
            <div class="rounded-t mb-0 px-6 py-6">
                <div class="text-center mb-3">
                    <h6 class="text-blueGray-500 text-sm font-bold">
                        Sign in with
                    </h6>
                </div>
                <div class="btn-wrapper text-center">
                    <button class="bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150" type="button">
                        <img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/notus-js/assets/img/github.svg">Github</button>
                    <button class="bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150" type="button">
                        <img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/notus-js/assets/img/google.svg">Google </button>

                </div>
                <hr class="mt-6 border-b-1 border-blueGray-300">
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <div class="text-blueGray-400 text-center mb-3 font-bold">
                    <small>Or sign in with credentials</small>
                </div>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Email</label>
                        <input name="email" type="email" type="email"
                               class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Email">
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Password</label>
                        <input type="password"  name="password" type="password"
                               class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Password">
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input id="remember-me customCheckLogin" type="checkbox" name="remember-me" type="checkbox"
                                   class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150">
                            <span class="ml-2 text-sm font-semibold text-blueGray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm ml-20 text-center text-gray-700 transition  hover:text-red-500">Forgot your Password?</a>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="modal-open bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"> Sign In </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-2 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center ">
                    <div class="w-5/12 mx-auto">
                        <img src="https://play-lh.googleusercontent.com/hSzPUT2DXP3uruTclgEZjWY6kW-AIGXwg8CRpzCrZPfGuurdi3NHjgGVtbtS2uqmVtI=h500"
                            alt="">
                    </div>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <div>
                    <label for="login" class="text-xs">Сертификат E-IMZO</label>
                    <input name="login" type="text" placeholder="Загрузка данных ключей" class="border-gray-200 w-full rounded-md">
                </div>
                <p class="text-gray-400 py-4">
                    [close] connection died
                </p>

                <!--Footer-->
                <div class="flex justify-center pt-2">
                    <button class="modal-close px-4 bg-blue-500 py-2 rounded-lg text-white hover:bg-blue-400">Вход</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }


    </script>
</section>
