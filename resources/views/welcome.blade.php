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

<body x-cloak x-data="{darkMode: $persist(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)}" :class="{'dark': darkMode === true }" class="antialiased">
    <nav class="bg-white dark:bg-gray-950 shadow-lg dark:shadow-gray-900 sticky top-0 z-[1000]">
        <div class="pt-3 md:px-5 md:py-5 lg:px-28" x-data="{ showMenu: false }">
            <div :class="showMenu ? 'px-5' : 'px-5'">
                <div class="flex justify-between pb-3 md:p-0" :class="showMenu && 'border-b-2'">
                    <a href="#" class="flex items-center">
                        <i class="fa-solid fa-shield-heart fa-2xl" style="color: #9333ea;"></i>
                        <p class="hidden md:block ml-2 text-2xl font-bold dark:text-white"> GrinWell Clinic </p>
                    </a>

                    <div class="flex items-center">
                        <button @click="darkMode = !darkMode" class="px-3 pb-3 lg:hidden">
                            <svg class="w-5 h-5 mt-1 absolute block transition duration-150" aria-hidden="true" fill="currentColor" :class="darkMode && 'opacity-0'" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                            <svg class="w-5 h-5 opacity-0 transition duration-150" aria-hidden="true" fill="white" :class="darkMode && 'opacity-100 -mb-1'" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>

                        <!-- Hamburger Menu Toggle (Mobile) -->
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
                    </div>

                    <!-- Nav Item (Desktop) -->
                    <div class="hidden md:block">
                        <button @click="darkMode = !darkMode" class="px-3">
                            <svg class="w-5 h-5 mt-1 absolute block transition duration-150" aria-hidden="true" fill="currentColor" :class="darkMode && 'opacity-0'" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                            <svg class="w-5 h-5 opacity-0 transition duration-150" aria-hidden="true" fill="white" :class="darkMode && 'opacity-100 -mb-1'" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>

                        <a href="#menu" class="px-3 text-lg font-semibold dark:hover:text-[#9333ea] dark:text-white"> Services </a>
                        <a href="#about" class="pl-3 pr-5 text-lg font-semibold dark:hover:text-[#9333ea] dark:text-white"> About Us </a>
                        @if (Route::has('registerPage'))
                        <a href="{{ route('registerPage') }}" class="px-5 py-2 text-white text-lg font-semibold bg-[#9333ea] rounded-lg hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> Book Now </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Hamburger Content -->
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
                        <li class="pt-2 pb-5 border-b-2">
                            @if (Route::has('registerPage'))
                            <a href="{{ route('registerPage') }}" class="bg-[#9333ea] px-4 py-1 rounded-lg text-lg font-semibold text-white"> Book Now </a>
                            @endif
                        </li>
                        <li class="py-2">
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

    <div class="px-5 py-40 flex dark:bg-gray-950 justify-center items-center md:py-5 md:px-10 lg:px-[132px] md:grid md:grid-cols-2 md:gap-10">
        <div class="col-start-1 col-end-1 m-auto">
            <h1 class="text-4xl font-semibold mb-5 dark:text-white">
                <font style="color: #9333ea; font-weight: 700;"> GrinWell Clinic </font> — Your Wellness, Our Priority!
            </h1>
            @if (Route::has('registerPage'))
            <a href="{{ route('registerPage') }}" class="px-5 py-2 text-white text-lg font-semibold bg-[#9333ea] rounded-lg hover:bg-[#4c1b7a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> Book Now </a>
            @endif
        </div>
        <div class="col-start-2 col-end-2">
            <img src="{{ asset('assets/img/home-image.svg') }}" alt="">
        </div>
    </div>
    <section id="menu" class="py-20 dark:bg-gray-950 bg-white">
        <div class="px-5 z-[900] flex dark:bg-gray-950 justify-center flex-col items-center md:pt-5 md:pb-12 md:px-10 lg:px-[132px]">
            <h1 class="text-4xl mb-5 font-semibold text-center dark:text-white">
                Services
            </h1>

            <!-- Carousel -->
            <div class="px-5 flex flex-col justify-center items-center">
                <div class="mx-auto relative" x-data="imageCarousel" x-init="loadImages()">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index" class="relative">
                            <img :src="slide.image" alt="Slide Image" class="w-full h-64 object-cover rounded-lg">
                            <div class="absolute bottom-0 left-0 right-0 rounded-b-lg bg-black bg-opacity-50 text-white p-4 text-center">
                                <h3 class="text-lg font-semibold" x-text="slide.description"></h3>
                            </div>
                        </div>
                    </template>

                    <!-- Prev/Next Arrows -->
                    <div class="absolute inset-0 flex">
                        <div class="flex items-center justify-start w-1/2">
                            <button class="bg-[#dfc2f9] text-[#9333ea] hover:text-[#4c1b7a] font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6" x-on:click="prevSlide">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-end w-1/2">
                            <button class="bg-[#dfc2f9] text-[#9333ea] hover:text-[#4c1b7a] font-bold hover:shadow rounded-full w-12 h-12 -mr-6" x-on:click="nextSlide">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Buttons Under Picture -->
                    <div class="absolute w-full flex items-center justify-center px-4">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-[#4c1b7a] hover:shadow-lg" :class="{ 'bg-[#9333ea]': activeSlide === index, 'bg-[#dfc2f9]': activeSlide !== index }" x-on:click="activeSlide = index"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about">
        <div class="px-5 py-20 flex dark:bg-gray-950 justify-center items-center md:pt-5 md:pb-12 md:px-10 lg:px-[132px] md:grid md:grid-cols-2 md:gap-10">
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
                        Welcome to GrinWell Clinic, where health meets care. At GrinWell Clinic, we are dedicated to providing personalized and compassionate healthcare services to our community. With a team of experienced and caring professionals, we strive to ensure that every patient receives the highest quality of medical attention in a warm and welcoming environment.
                    </p>
                    <br>
                    <p class="dark:text-white">
                        Our mission is to promote wellness and enhance the overall health of our patients through comprehensive and innovative medical solutions. Whether you're seeking routine check-ups, specialized treatments, or preventive care, GrinWell Clinic is committed to being your trusted healthcare partner.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Carousel Script -->
    <script>
        const imageCarousel = () => ({
            activeSlide: 0,
            slides: [],

            loadImages() {
                this.slides = [{
                        image: 'https://picsum.photos/id/1025/800/400',
                        description: 'Combo'
                    },
                    {
                        image: 'https://picsum.photos/id/1015/800/401',
                        description: 'Ala Carte'
                    },
                    {
                        image: 'https://picsum.photos/id/1025/800/402',
                        description: 'Drink'
                    },
                    {
                        image: 'https://picsum.photos/id/1019/800/403',
                        description: 'Snack'
                    },
                ];
            },

            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },

            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            },
        });

        // Alpine.data('imageCarousel', imageCarousel); <- possibly in use
    </script>

</body>

</html>