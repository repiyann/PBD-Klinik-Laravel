<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GrinWell Clinic </title>

    <!-- Styles  -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-cloak x-data="{darkMode: $persist(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)}" :class="{'dark': darkMode === true }" class="antialiased">
    <!-- Check Responsiveness of a Page -->

    @auth

    <!-- NavBar Start -->
    <nav class="bg-white dark:bg-gray-950 shadow-lg dark:shadow-gray-900 sticky top-0 z-[1000]">
        <div class="pt-3 md:px-5 md:py-5 lg:px-28" x-data="{ showMenu: false }">
            <div :class="showMenu ? 'px-5' : 'px-5'">
                <div class="flex justify-between pb-3 md:p-0" :class="showMenu && 'border-b-2'">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <i class="fa-solid fa-shield-heart fa-2xl" style="color: #9333ea;"></i>
                        <p class="hidden md:block ml-2 text-2xl font-bold dark:text-white"> GrinWell Clinic </p>
                    </a>

                    <!-- Toggle for hamburger menu in mobile layout with animation -->
                    <div @click="showMenu = !showMenu" class="md:hidden">
                        <button>
                            <svg class="absolute block transition duration-150" :class="showMenu && 'rotate-45 opacity-0'" xmlns="http://www.w3.org/2000/svg" height="24" width="21" viewBox="0 0 448 512">
                                <path fill="#9333ea" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                            </svg>
                            <svg class="opacity-0 transition duration-150" :class="showMenu && 'rotate-90 opacity-100'" xmlns="http://www.w3.org/2000/svg" height="24" width="18" viewBox="0 0 384 512">
                                <path fill="#9333ea" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Item navigation for desktop layout -->
                    <div class="hidden md:block">
                        <div x-data="{ openProfile: false }">
                            <div x-data="{ openNotif: false, hasNotifications: true }">

                                <!-- Start::Toggle for dark mode -->
                                <button @click="darkMode = !darkMode" class="px-3">
                                    <svg class="w-5 h-5 mt-1 absolute block transition duration-150" aria-hidden="true" fill="currentColor" :class="darkMode && 'opacity-0'" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <svg class="w-5 h-5 opacity-0 transition duration-150" aria-hidden="true" fill="white" :class="darkMode && 'opacity-100 -mb-1'" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                    </svg>
                                </button>
                                <!-- End::Toggle for dark mode -->

                                <!-- Notif Button Start -->
                                <button x-ref="notifButton" class="relative px-3 py-1 mr-3 text-white text-lg font-semibold bg-[#9333ea] rounded-full hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" @click="openNotif = !openNotif">
                                    <i class="fa-solid fa-bell fa-sm"></i>
                                    <span x-show="hasNotifications" class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full"></span>
                                </button>

                                <div x-show="openNotif" x-anchor.bottom-end="$refs.notifButton" @click.outside="openNotif = false" class="bg-white border rounded-lg shadow-md mt-5 py-2 w-48">
                                    <ul>
                                        <li>
                                            <p class="block px-4 pb-2 text-gray-800 font-bold text-center shadow-sm uppercase"> Notifications </p>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 font-semibold">Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 font-semibold">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Notif Button End -->

                                <!-- Start::Profile Button -->
                                <button x-ref="profileButton" class="px-3 py-1 text-white text-lg font-semibold bg-[#9333ea] rounded-full hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" @click="openProfile = ! openProfile">
                                    <i class="fa-solid fa-user fa-sm"></i>
                                </button>

                                <div x-show="openProfile" x-anchor.bottom-end="$refs.profileButton" @click.outside="openProfile = false" class="bg-white border rounded-lg shadow-md mt-5 py-2 w-48">
                                    <ul>
                                        <li>
                                            <p class="block px-4 pb-2 text-gray-800 font-bold text-center shadow-sm uppercase">{{ Auth::user()->name }}</p>
                                        </li>
                                        <li>
                                            <a href="{{ route('viewProfile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 font-semibold">Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 font-semibold">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End::Profile Button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger menu content for mobile view -->
            <div x-cloak x-show="showMenu" @click.outside="showMenu = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                <div class="absolute md:hidden bg-white dark:bg-gray-950 shadow-lg dark:shadow-gray-900 w-full justify-center text-center">
                    <ul class="px-5">
                        <li class="pt-2">
                            <a href="#" class="text-lg font-semibold dark:text-white"> Home </a>
                        </li>
                        <li class="">
                            <a href="#menu" class="text-lg font-semibold dark:text-white"> Services </a>
                        </li>
                        <li class="">
                            <a href="#about" class="text-lg font-semibold dark:text-white"> About Us </a>
                        </li>
                        <li class="pb-2 border-b-2">
                            <a href="{{ route('logout') }}" class="text-lg font-semibold dark:text-white"> Logout </a>
                        </li>
                        <li class="py-2">
                            <!-- Toggle for dark mode in mobile view -->
                            <button @click="darkMode = !darkMode" class="px-3 md:hidden">
                                <svg class="w-5 h-5 absolute block transition duration-150" aria-hidden="true" fill="#9333ea" :class="darkMode && 'opacity-0'" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-5 h-5 opacity-0 transition duration-150" aria-hidden="true" fill="#9333ea" :class="darkMode && 'opacity-100'" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
    <!-- NavBar End -->
    @endauth

    <!-- Start::Form -->
    <div class="flex items-center justify-center lg:py-12 py-5 px-5">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="https://formbold.com/s/FORM_ID" method="POST">
                <div class="-mx-3 flex flex-wrap">
                    <h3 class="w-full text-center text-2xl font-semibold mb-4"> Patient's Form </h3>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="fName" class="block text-base font-medium text-[#07074D]">
                                First Name
                            </label>
                            <input type="text" name="fName" id="fName" placeholder="First Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="lName" class="block text-base font-medium text-[#07074D]">
                                Last Name
                            </label>
                            <input type="text" name="lName" id="lName" placeholder="Last Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="guest" class="block text-base font-medium text-[#07074D]">
                        National Identity Number
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="5" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mb-5">
                    <label for="guest" class="block text-base font-medium text-[#07074D]">
                        Address
                    </label>
                    <input type="text" name="guest" id="guest" placeholder="5" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="date" class="block text-base font-medium text-[#07074D]">
                                Date of Birth
                            </label>
                            <input type="date" name="date" id="date" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <!-- <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="time" class="mb-3 block text-base font-medium text-[#07074D]">
                                Time
                            </label>
                            <input type="time" name="time" id="time" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div> -->
                </div>

                <div>
                    <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End::Form -->
</body>

</html>