<aside class="z-20 lg:px-28 hidden w-auto overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <p class="ml-6 text-2xl font-bold text-gray-800 dark:text-gray-200 border-b-2 p-2">
            User Profile
        </p>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->segment(1) == 'profile')
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-lg font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ (request()->segment(1) == 'profile') ? 'text-gray-800 dark:text-gray-100' : '' }} " href="{{ route('viewProfile') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4"> Account </span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->segment(1) == 'record')
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-lg font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ (request()->segment(1) == 'record') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ route('viewRecord') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4"> Record </span>
                </a>
            </li>
        </ul>
    </div>
</aside>