// Dashboard JS
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // toggle for enabling selection
    $('input[name="recordOption"]').change(function() {
        if (this.value === 'existing') {
            $('#existingRecordSection').show();
            $('#fName').attr('disabled', 'disabled');
        } else {
            $('#existingRecordSection').hide();
            $('#fName').removeAttr('disabled');
        }
    });
    // fill input with existing record
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
    // initialize datepicker
    $(function() {
        var daysOfWeekDisabled = [0, 6];
        var today = new Date();
        var oneMonthFromToday = new Date();
        oneMonthFromToday.setMonth(today.getMonth() + 1);

        var datePicker = $("#workDaysInput").datepicker({
            minDate: today,
            maxDate: oneMonthFromToday,
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(daysOfWeekDisabled.indexOf(day) == -1)];
            }
        });

        datePicker.prop('disabled', true);

        $('#clinicService').change(function() {
            datePicker.prop('disabled', false);
        });

        $('#workDaysInput').change(function() {
            let service = $('#clinicService').val();
            let selectedDate = new Date($(this).val());

            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            var dateString = selectedDate.toLocaleDateString('en-GB', options);
            var encodedDateString = encodeURIComponent(dateString);
            var dayOfWeek = selectedDate.toLocaleDateString('en-US', {
                weekday: 'long'
            });
            $('#workDaysInput').val(dateString);

            let doctorSelect = $('#doctorSelect');
            $.ajax({
                url: '/dashboard/' + service + '/' + dayOfWeek,
                success: function(data) {
                    doctorSelect.empty();
                    $.each(data, function(index, doctor) {
                        var startWork = new Date('1970-01-01T' + doctor.start_work + 'Z');
                        var endWork = new Date('1970-01-01T' + doctor.end_work + 'Z');
                    
                        // Format the times to show only the hour and minute
                        var formattedStartWork = ('0' + startWork.getUTCHours()).slice(-2) + ':' + ('0' + startWork.getUTCMinutes()).slice(-2);
                        var formattedEndWork = ('0' + endWork.getUTCHours()).slice(-2) + ':' + ('0' + endWork.getUTCMinutes()).slice(-2);
                    
                        var optionText = formattedStartWork + ' - ' + formattedEndWork + ' | ' + doctor.name;
                        
                        var option = $('<option>', {
                            value: doctor.id,
                            text: optionText
                        });

                        doctorSelect.append(option);
                    });
                }
            });
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
$('a[href="#menu"], a[href="#about"]').click(function(event) {
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