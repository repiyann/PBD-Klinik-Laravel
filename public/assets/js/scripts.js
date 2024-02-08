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
            $('#fName').val(data.firstName);
            $('#lName').val(data.lastName);
            $('#nik').val(data.nationalID);
            $('#birthdate').val(data.birthDate);
            $('#address').val(data.address);
            $('#notes').val(data.notes);
        });
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

            const doctorSelect = $('#doctorSelect').empty().append('<option selected disabled> Choose Doctor </option>');
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
        const selectedDoctorID = $(this).val();
        const selectedDoctor = doctorData.find(doctor => doctor.id == selectedDoctorID);

        if (selectedDoctor) {
            var startWork = new Date('1970-01-01T' + selectedDoctor.start_work + 'Z');
            var endWork = new Date('1970-01-01T' + selectedDoctor.end_work + 'Z');

            const timeSlotsLabel = $('#timeSlotsLabel').empty().append($('<label>', {
                for: 'timeSlot',
                text: 'Time Slots',
                class: 'block text-base font-medium text-[#07074D] dark:text-white',
            }));
            const timeSlots = $('#timeSlots').empty();

            const interval = 60 * 60 * 1000;
            for (let currentTime = startWork; currentTime < endWork; currentTime = new Date(currentTime.getTime() + interval)) {
                const formattedTime = currentTime.toISOString().slice(11, 16);

                const radioBtn = $('<input>', {
                    type: 'radio',
                    name: 'timeSlot',
                    value: formattedTime,
                    id: `timeSlot_${formattedTime.replace(/:/g, '')}`,
                });
                const label = $('<label>', {
                    for: `timeSlot_${formattedTime.replace(/:/g, '')}`,
                    text: formattedTime,
                    class: 'pr-5',
                });

                const div = $('<div>').append(radioBtn).append(label);
                timeSlots.append(div);
            }
        }
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