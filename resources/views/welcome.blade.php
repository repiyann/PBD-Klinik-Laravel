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
    <nav class="bg-white shadow-lg sticky">
        <div class="px-5 pt-3 md:px-28 md:py-5" x-data="{ showMenu: false }">
            <div class="flex justify-between border-b md:border-none pb-3 md:p-0">
                <a href="#">
                    <i class="fa-solid fa-heart-pulse fa-2xl"></i>
                </a>

                <!-- Toggle for hamburger menu in mobile layout -->
                <div @click="showMenu = true" class="md:hidden">
                    <button class="group" aria-expanded="false">
                        <svg class="absolute block transition duration-150 group-focus:rotate-45 group-focus:opacity-0" xmlns="http://www.w3.org/2000/svg" height="24" width="21" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
                        <svg class="opacity-0 transition duration-150 group-focus:rotate-90 group-focus:opacity-100" xmlns="http://www.w3.org/2000/svg" height="24" width="18" viewBox="0 0 384 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                <!-- Middle item navigation for desktop layout -->
                <div class="hidden md:block">
                    <a href="#" class="px-3"> Layanan </a>
                    <a href="#" class="px-3"> About Us </a>
                </div>

                <!-- Login button only for desktop layout -->
                <div class="hidden md:block">
                    <a href="#" class="px-3"> Daftar </a>
                </div>
            </div>

            <!-- Hamburger menu content -->
            <div x-cloak @click.outside="showMenu = false" x-show="showMenu" x-collapse>
                <div class="flex justify-center md:hidden pb-3">
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

</body>

</html>