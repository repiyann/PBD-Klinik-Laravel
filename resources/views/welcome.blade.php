<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Project </title>

    <!-- Styles  -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <!-- Check Responsiveness of a Page -->

    <!-- NavBar Start -->
    <nav class="bg-white shadow-lg sticky top-0">
        <div class="px-5 pt-3 md:px-28 md:py-5" x-data="{ showMenu: false }" aria-hidden="true">
            <div class="flex justify-between pb-3 md:p-0" :class="showMenu && 'border-b-2'">
                <a href="#">
                    <i class="fa-solid fa-van-shuttle fa-2xl"></i>
                </a>

                <!-- Toggle for hamburger menu in mobile layout with animation -->
                <div @click="showMenu = !showMenu" class="md:hidden">
                    <button>
                        <svg class="absolute block transition duration-150" :class="showMenu && 'rotate-45 opacity-0'" xmlns="http://www.w3.org/2000/svg" height="24" width="21" viewBox="0 0 448 512">
                            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
                        <svg class="opacity-0 transition duration-150" :class="showMenu && 'rotate-90 opacity-100'" xmlns="http://www.w3.org/2000/svg" height="24" width="18" viewBox="0 0 384 512">
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                <!-- Middle item navigation for desktop layout -->
                <div class="hidden md:block">
                    <a href="#" class="px-3 text-lg font-semibold"> Layanan </a>
                    <a href="#" class="px-3 text-lg font-semibold"> About Us </a>
                </div>

                <!-- Login button only for desktop layout -->
                <div class="hidden md:block">
                    <a href="#" class="px-5 py-2 text-lg font-semibold bg-green-500 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> Cek Tiket </a>
                </div>
            </div>

            <!-- Hamburger menu content -->
            <div x-cloak x-show="showMenu" @click.outside="showMenu = false">
                <div class="flex justify-center text-center md:hidden pb-3">
                    <ul>
                        <li class="pt-2">
                            <a href="#"> Layanan </a>
                        </li>
                        <li class="pt-2">
                            <a href="#"> About Us </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
    <!-- NavBar End -->

    <!-- Hero Start -->
    <div aria-hidden="true">
        <h1> Hai </h1>
    </div>
    <!-- Hero End -->
</body>

</html>