<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GrinWell Clinic </title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body x-cloak x-data="{darkMode: $persist(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)}" :class="{'dark': darkMode === true }" class="antialiased">
    @auth
    @include('layouts/user/navbar')
    <div class="flex items-center justify-center lg:py-12 py-5 px-5 dark:bg-gray-800">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="" method="POST">
                <div class="-mx-3 flex flex-wrap">
                    <h3 class="w-full text-center text-2xl font-semibold mb-4 dark:text-white"> Reservation Form </h3>

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
                                @foreach ($records as $record)
                                <option selected disabled> Choose Record </option>
                                <option value="{{ $record->id }}">{{ $record->firstName }} {{ $record->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="fName" class="block text-base font-medium text-[#07074D] dark:text-white">
                                First Name
                            </label>
                            <input type="text" name="firstName" id="fName" placeholder="First Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
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
                <div class="mb-5">
                    <label for="clinicService" class="block text-base font-medium text-[#07074D] dark:text-white">
                        Clinic Service
                    </label>
                    <select name="clinicService" id="clinicService" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option selected disabled> Choose Service </option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="doctorSelect" class="block text-base font-medium text-[#07074D] dark:text-white">
                        Doctors
                    </label>
                    <select name="doctorSelect" id="doctorSelect" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option selected disabled> Choose Service </option>
                    </select>
                </div>

                <div>
                    <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endauth

    <script>
        $(document).ready(function() {
            $('input[name="recordOption"]').change(function() {
                if (this.value === 'existing') {
                    $('#existingRecordSection').show();
                    $('#fName').attr('disabled', 'disabled');
                } else {
                    $('#existingRecordSection').hide();
                    $('#fName').removeAttr('disabled');
                }
            });
            $('#existingRecord').change(function() {
                const selectedRecord = $(this).val();
                $.ajax({
                    url: '/dashboard/records/' + selectedRecord,
                    success: function(data) {
                        $('#fName').val(data.firstName);
                        $('#lName').val(data.lastName);
                        $('#nik').val(data.nationalID);
                        $('#birthdate').val(data.birthDate);
                        $('#address').val(data.address);
                        $('#notes').val(data.notes);
                    }
                });
            });
            $('#clinicService').change(function() {
                const selectedService = $(this).val();
                $.ajax({
                    url: '/dashboard/doctors/' + selectedService,
                    success: function(data) {
                        var doctorsSelect = $('#doctorSelect');
                        doctorsSelect.empty();
                        doctorsSelect.append('<option selected disabled> Choose Service </option>');

                        $.each(data, function(key, doctor) {
                            doctorsSelect.append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>