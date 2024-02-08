// Dashboard JS
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // toggle for enabling selection
    $('input[name="recordOption"]').change(function () {
        const isExisting = this.value === 'existing';
        $('#existingRecordSection').toggle(isExisting);
        $('#fName').prop('disabled', isExisting);
    });

    // fill input with existing record
    $('#existingRecord').change(function () {
        const selectedRecord = $(this).val();
        $.get('/dashboard/records/' + selectedRecord, function (data) {
            $('#firstName').val(data.firstName);
            $('#lName').val(data.lastName);
            $('#nik').val(data.nationalID);
            $('#birthdate').val(data.birthDate);
            $('#address').val(data.address);
            $('#notes').val(data.notes);
        });
    });

    $('form').submit(function () {
        $('#fName').val(data.firstName);
    });

    // clear all selection if select from first
    $('#clinicService').change(function () {
        $('#workDaysInput').val('');
        $('#doctorSelect').empty().append('<option selected disabled> Choose Doctor </option>');
        $('#timeSlotsLabel').empty();
        $('#timeSlots').empty();
    });

    // global data
    var doctorData;

    // initialize datepicker
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
            url: '/check-timeslot-availability/',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                console.log('Response:', response);

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

// Welcome JS
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
$('a[href="#menu"], a[href="#about"]').click(event => {
    event.preventDefault();
    var target = $(this.hash);
    $('html, body').animate({
        scrollTop: target.offset().top
    }, 1000);
});
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}