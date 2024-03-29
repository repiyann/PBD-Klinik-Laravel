$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name="recordOption"]').change(function () {
        const isNew = this.value === 'new';
        if (isNew) {
            $('#firstName').val('');
            $('#lName').val('');
            $('#nik').val('');
            $('#birthdate').val('');
            $('#address').val('');
            $('#notes').val('');
            $('#existingRecordSection').hide();
        } else {
            $('#existingRecordSection').show();
            $('#existingRecord').prop('selectedIndex', 0);
        }
    });

    $('#existingRecord').change(function () {
        const selectedRecord = $(this).val();
        $.get('/dashboard/records/' + selectedRecord, function (data) {
            $('#firstName').val(data.firstName).prop('disabled', true);
            $('#lName').val(data.lastName).prop('disabled', true);
            $('#nik').val(data.nationalID).prop('disabled', true);
            $('#birthdate').val(data.birthDate).prop('disabled', true);
            $('#address').val(data.address).prop('disabled', true);
            $('#notes').val(data.notes).prop('disabled', true);

            $('#submitFormButton').prop('disabled', false);

            $('form').append(
                $('<input>', { type: 'hidden', name: 'firstName', value: data.firstName }),
                $('<input>', { type: 'hidden', name: 'lastName', value: data.lastName }),
                $('<input>', { type: 'hidden', name: 'nik', value: data.nationalID }),
                $('<input>', { type: 'hidden', name: 'dateOfBirth', value: data.birthDate }),
                $('<input>', { type: 'hidden', name: 'address', value: data.address }),
                $('<input>', { type: 'hidden', name: 'notes', value: data.notes }),
            );
        });
    });

    $('#submitFormButton').click(function () {
        $('form').submit();
    });

    $('#clinicService').change(function () {
        $('#workDaysInput').val('');
        $('#doctorSelect').empty().append('<option selected disabled> Choose Doctor </option>');
        $('#timeSlotsLabel').empty();
        $('#timeSlots').empty();
    });

    $(function () {
        var daysOfWeekDisabled = [0, 6];
        var datePicker = $("#workDaysInput").datepicker({
            minDate: new Date(),
            maxDate: '+30d',
            beforeShowDay: date => [!daysOfWeekDisabled.includes(date.getDay())]
        }).prop('disabled', true);

        $('#clinicService').change(() => datePicker.prop('disabled', false));

        $('#workDaysInput').change(function () {
            let service = $('#clinicService').val();
            let selectedDate = new Date($(this).val());
            let adjustedDate = new Date(selectedDate.getTime() - (selectedDate.getTimezoneOffset() * 60000));
            $('#hiddenDateInput').val(adjustedDate.toISOString().split('T')[0]);

            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            var dateString = selectedDate.toLocaleDateString('en-GB', options);
            var dayOfWeek = selectedDate.toLocaleDateString('en-GB', { weekday: 'long' });
            $('#workDaysInput').val(dateString);

            $('#doctorSelect').empty().append('<option selected disabled> Choose Doctor </option>');
            $.get('/dashboard/' + service + '/' + dayOfWeek, function (data) {
                doctorData = data;
                $('#timeSlotsLabel, #timeSlots').empty();

                data.forEach(doctor => {
                    var startWork = new Date('1970-01-01T' + doctor.start_work + 'Z');
                    var endWork = new Date('1970-01-01T' + doctor.end_work + 'Z');
                    var formattedStartWork = ('0' + startWork.getUTCHours()).slice(-2) + ':' + ('0' + startWork.getUTCMinutes()).slice(-2);
                    var formattedEndWork = ('0' + endWork.getUTCHours()).slice(-2) + ':' + ('0' + endWork.getUTCMinutes()).slice(-2);
                    var optionText = formattedStartWork + ' - ' + formattedEndWork + ' | ' + doctor.name;

                    var option = $('<option>', {
                        value: doctor.id,
                        text: optionText
                    });

                    $('#doctorSelect').append(option);
                });
            });
        });
    });

    $('#doctorSelect').change(function () {
        const data = {
            clinicService: $('#clinicService').val(),
            dateAvailable: $('#hiddenDateInput').val(),
            doctorID: $(this).val(),
        };

        $.ajax({
            url: '/dashboard/timeSlot/',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                const timeSlotsLabel = $('#timeSlotsLabel').empty().append($('<label>', {
                    for: 'timeSlot',
                    text: 'Time Slots',
                    class: 'block text-base font-medium text-[#07074D] dark:text-white',
                }));
                const timeSlotsDiv = $('#timeSlots').empty();

                const currentTime = new Date();
                const options = { hour: '2-digit', minute: '2-digit', hour12: false, timeZone: 'Asia/Jakarta' };
                const currentFormattedTime = currentTime.toLocaleTimeString('id-ID', options);
                const currentDate = currentTime.toLocaleDateString('id-ID');
                const dateAvailable = new Date($('#hiddenDateInput').val()).toLocaleDateString('id-ID');
                let noSlotMessageAdded = false;

                response.availableTimeSlots.forEach(function (formattedTime) {
                    if (currentDate === dateAvailable && formattedTime <= currentFormattedTime && !noSlotMessageAdded) {
                        timeSlotsLabel.append('<div class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert"><p>No Slot for Appointment!</p></div>');
                        noSlotMessageAdded = true;
                    } else if (formattedTime > currentFormattedTime || currentDate !== dateAvailable) {
                        const formattedTimeHi = formattedTime.slice(0, 5);

                        const radioBtn = $('<input>', {
                            type: 'radio',
                            name: 'timeSlot',
                            value: formattedTimeHi,
                            id: `timeSlot_${formattedTime.replace(/:/g, '')}`,
                        });

                        const label = $('<label>', {
                            for: `timeSlot_${formattedTime.replace(/:/g, '')}`,
                            text: formattedTimeHi,
                            class: 'pr-5',
                        });

                        timeSlotsDiv.append($('<div>').append(radioBtn, label));
                    }
                });
            },
            error: function (error) {
                timeSlotsLabel.append('<div class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert"><p>Error Checking Time Slot Availability'+ error +'!</p></div>');
            }
        });
    });
});