<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GrinWell Clinic </title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-primary">
    <section class="flex flex-col md:flex-row h-screen items-center">
        <div class="bg-indigo-600 hidden lg:flex justify-center w-full md:w-1/2 xl:w-2/3 h-screen border-r-2">
            <div class="flex items-center">
                <img src="{{ asset('assets/img/auth-image.svg') }}" alt="" class="w-3/4 h-3/4 object-cover mx-auto">
            </div>
        </div>

        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
            <div class="w-full h-100">
                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12"> Create your account </h1>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif

                <form class="mt-6" action="{{ route('createUser') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700"> Name </label>
                        <input type="text" name="name" id="inputName" placeholder="Enter Name" class="w-full px-4 py-3 rounded-lg bg-[#e7def7] mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700"> Email Address </label>
                        <input type="email" name="email" id="inputEmail" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-[#e7def7] mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700"> Password </label>
                        <input type="password" name="password" id="inputPassword" placeholder="Enter Password" minlength="8" class="w-full px-4 py-3 rounded-lg bg-[#e7def7] mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700"> Confirm Password </label>
                        <input type="password" name="password_confirmation" id="inputConfirmPassword" placeholder="Enter Confirm Password" minlength="8" class="w-full px-4 py-3 rounded-lg bg-[#e7def7] mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" required>
                    </div>
                    <button type="submit" class="w-full block bg-[#9333ea] hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 text-white font-semibold rounded-lg px-4 py-3 mt-6"> Sign In </button>
                </form>
                
                <hr class="my-6 border-gray-300 w-full">
                <p class="mt-2"> Have an account? <a href="{{ route('login')}}" class="text-blue-500 hover:text-blue-700 font-semibold">Log in</a></p>
            </div>
        </div>
    </section>
</body>

</html>