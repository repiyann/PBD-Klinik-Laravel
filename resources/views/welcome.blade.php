<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Project </title>

    <!-- Styles  -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-cloak x-data="{darkMode: $persist(false)}" :class="{'dark': darkMode === true }" class="antialiased">
    <!-- Check Responsiveness of a Page -->

    <!-- NavBar Start -->
    <nav class="bg-white dark:bg-gray-950 shadow-lg dark:shadow-gray-900 sticky top-0">
        <div class="pt-3 md:px-28 md:py-5" x-data="{ showMenu: false }">
            <div :class="showMenu ? 'px-5' : 'px-5'">
                <div class="flex justify-between pb-3 md:p-0" :class="showMenu && 'border-b-2'">
                    <a href="#" class="flex items-center">
                        <i class="fa-solid fa-drumstick-bite fa-2xl" style="color: #9333ea;"></i>
                        <p class="hidden md:block ml-2 text-2xl font-bold dark:text-white"> Ka-Chew Fried Chicken</p>
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

                        <!-- Toggle for dark mode -->
                        <button @click="darkMode = !darkMode" class="px-3">
                            <svg class="w-5 h-5 mt-1 absolute block transition duration-150" aria-hidden="true" fill="currentColor" :class="darkMode && 'opacity-0'" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                            <svg class="w-5 h-5 opacity-0 transition duration-150" aria-hidden="true" fill="white" :class="darkMode && 'opacity-100 -mb-1'" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>

                        <a href="#menu" class="px-3 text-lg font-semibold dark:text-white"> Menu </a>
                        <a href="#about" class="pl-3 pr-5 text-lg font-semibold dark:text-white"> About Us </a>
                        <a href="#" class="px-5 py-2 text-white text-lg font-semibold bg-[#9333ea] rounded-lg hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> Order Now </a>
                    </div>
                </div>
            </div>

            <!-- Hamburger menu content -->
            <div x-cloak x-show="showMenu" @click.outside="showMenu = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                <div class="absolute md:hidden bg-white dark:bg-gray-950 shadow-lg dark:shadow-gray-900 w-full justify-center text-center">
                    <ul class="px-5">
                        <li class="pt-2">
                            <a href="#menu" class="text-lg font-semibold dark:text-white"> Menu </a>
                        </li>
                        <li class="">
                            <a href="#about" class="text-lg font-semibold dark:text-white"> About Us </a>
                        </li>
                        <li class="pt-2 pb-5 border-b-2">
                            <a href="#" class="bg-[#9333ea] px-2 py-1 rounded-lg text-lg font-semibold text-white"> Order Now </a>
                        </li>
                        <li class="py-2">
                            <!-- Toggle for dark mode in mobile -->
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

    <!-- Hero Start -->
    <div class="px-5 py-40 flex dark:bg-gray-950 justify-center items-center md:py-5 md:px-[132px] md:grid md:grid-cols-2 md:gap-10">
        <div class="col-start-1 col-end-1 m-auto">
            <h1 class="text-4xl font-semibold mb-5 dark:text-white">
                Ka-Chew Fried Chicken — Where Flavor Meets Velocity!
            </h1>
            <a href="#" class="px-5 py-2 text-white text-lg font-semibold bg-[#9333ea] rounded-lg hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> Order Now </a>
        </div>
        <div class="col-start-2 col-end-2">
            <img src="{{ asset('assets/img/home-image.svg') }}" alt="">
        </div>
    </div>
    <section id="menu">
        <div class="px-5 py-20 flex dark:bg-gray-950 justify-center items-center md:pt-5 md:pb-12 md:px-[132px]">
            <h1 class="text-4xl mb-5 font-semibold text-center dark:text-white">
                Menu
            </h1>
        </div>
    </section>
    <section id="about">
        <div class="px-5 py-20 flex dark:bg-gray-950 justify-center items-center md:pt-5 md:pb-12 md:px-[132px] md:grid md:grid-cols-2 md:gap-10">
            <div class="col-start-1 col-end-1 mt-5">
                <img src="{{ asset('assets/img/about-image.svg') }}" alt="">
            </div>
            <div class="col-start-2 col-end-2 m-auto">
                <h1 class="text-4xl mb-5 font-semibold dark:text-white">
                    About us
                </h1>
                <h3 class="text-2xl mb-1 font-semibold dark:text-white">
                    Why choose us?
                </h3>
                <br>
                <div class="text-justify">
                    <p class="mb-1 dark:text-white">
                        Ka-Chew Fried Chicken is not just an ordinary chicken restaurant. We bring more than just the delicious taste of chicken. With a focus on quality, express service and unmatched cleanliness, Ka-Chew Fried Chicken is your top choice.
                    </p>
                    <br>
                    <p class="dark:text-white">
                        Ka-Chew Fried Chicken is not just a chicken restaurant, but a culinary destination that provides a complete dining experience. When you choose us, you choose quality, speed, and deliciousness. Enjoy every culinary moment with Ka-Chew Fried Chicken!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero End -->

</body>

</html>