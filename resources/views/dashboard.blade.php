<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> GrinWell Clinic </title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/js/scriptDashboard.js') }}"></script>
</head>

<body x-cloak x-data="{darkMode: $persist(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)}" :class="{'dark': darkMode === true }" class="antialiased">
    @include('layouts/user/navbar')
    <div class="flex items-center justify-center lg:py-12 py-5 px-5 dark:bg-gray-800">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="{{ route('tesCok') }}" method="POST">
                @csrf
                @method('POST')
                <div class="tabs">
                    <div class="-mx-3 flex flex-wrap">
                        <h2 class="w-full text-center text-2xl font-semibold mb-4 dark:text-white"> Reservation Form </h2>
                        @if ($errors->any())
                        <div class="bg-red-100 mb-5 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                            <p>{{ $errors->first() }}</p>
                        </div>
                        @endif
                        @if ($userHasRecord)
                        <div class="px-3">
                            <label class="block text-base font-medium text-[#07074D] dark:text-white">
                                Record Option:
                            </label>
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <label class="flex items-center mr-4">
                                        <input type="radio" name="recordOption" value="existing" class="form-radio" />
                                        <span class="ml-2 dark:text-white">Existing Record</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="recordOption" value="new" class="form-radio" checked />
                                        <span class="ml-2 dark:text-white">New Record</span>
                                    </label>
                                </div>
                            </div>
                            <div id="existingRecordSection" class="hidden mb-5">
                                <label for="existingRecord" class="block text-base font-medium text-[#07074D] dark:text-white">
                                    Select Record:
                                </label>
                                <select name="existingRecord" id="existingRecord" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                    <option selected disabled> Choose Record </option>
                                    @foreach ($records as $record)
                                    <option value="{{ $record->id }}">{{ $record->firstName }} {{ $record->lastName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>

                    <section id="account-info" class="tab-content mt-5 card dark:bg-gray-700">
                        <h3 class="w-full text-center text-xl font-semibold mb-4 dark:text-white"> Patient's Detail </h3>
                        <div class="-mx-3 flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="mb-5">
                                    <label for="fName" class="block text-base font-medium text-[#07074D] dark:text-white">
                                        First Name
                                    </label>
                                    <input type="text" name="firstName" id="firstName" placeholder="First Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="mb-5">
                                    <label for="lName" class="block text-base font-medium text-[#07074D] dark:text-white">
                                        Last Name
                                    </label>
                                    <input type="text" name="lastName" id="lName" placeholder="Last Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                        </div>

                        <div class="-mx-3 flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="mb-5">
                                    <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                                        National Identity Number
                                    </label>
                                    <input type="text" name="nik" id="nik" placeholder="National Identity Number" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="mb-5">
                                    <label for="date" class="block text-base font-medium text-[#07074D] dark:text-white">
                                        Date of Birth
                                    </label>
                                    <input type="date" name="dateOfBirth" id="birthdate" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Address
                            </label>
                            <textarea type="text" name="address" id="address" placeholder="Address" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="guest" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Notes
                            </label>
                            <textarea type="text" name="notes" id="notes" placeholder="Address" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                        </div>
                    </section>

                    <section id="account-info" class="tab-content card dark:bg-gray-700">
                        <h3 class="w-full text-center text-xl font-semibold mb-4 dark:text-white"> Doctor's Detail </h3>
                        <div class="mb-5">
                            <label for="clinicService" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Clinic Service
                            </label>
                            <select name="clinicService" id="clinicService" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected disabled> Choose Service </option>
                                @foreach ($services as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="dateAvailable" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Date Available
                            </label>
                            <input type="text" name="dateAvailableTest" readonly id="workDaysInput" class="cursor-pointer w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            <input type="hidden" id="hiddenDateInput" name="dateAvailable">
                        </div>
                        <div class="mb-5">
                            <label for="doctorSelect" class="block text-base font-medium text-[#07074D] dark:text-white">
                                Doctors
                            </label>
                            <select name="doctorSelect" id="doctorSelect" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected disabled> Choose Doctor </option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <div id="timeSlotsLabel" class="mt-2">
                            </div>
                            <div id="timeSlots" class="grid grid-cols-2 lg:grid-cols-3 gap-3"></div>
                        </div>
                    </section>
                    <div>
                        <button id="submitFormButton" class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>