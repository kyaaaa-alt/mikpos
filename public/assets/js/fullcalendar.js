//FULL CALENDAR

document.addEventListener('DOMContentLoaded', function() {
    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText.trim(),
                title: eventEl.innerText,
                className: eventEl.className + ' overflow-hidden '
            }
        }
    });
    var calendarEl = document.getElementById('calendar2');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        defaultView: 'month',
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        selectable: true,
        selectMirror: true,
        droppable: true, // this allows things to be dropped onto the calendar
        select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
            }
            calendar.unselect()
        },
        eventClick: function(arg) {
            if (confirm('Are you sure you want to delete this event?')) {
                arg.event.remove()
            }
        },
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [{
                title: 'Business Lunch',
                start: '2021-03-03T13:00:00',
                constraint: 'businessHours'
            }, {
                title: 'Meeting',
                start: '2021-03-13T11:00:00',
                constraint: 'availableForMeeting', // defined below
                color: '#f35e90'
            }, {
                title: 'Conference',
                start: '2021-07-18',
                end: '2021-07-20',
                color: '#e67e22'
            }, {
                title: 'Party',
                start: '2021-07-29T20:00:00',
                color: '#22c865'
            },
            // areas where "Meeting" must be dropped
            {
                id: 'availableForMeeting',
                start: '2021-03-11T10:00:00',
                end: '2021-03-11T16:00:00',
                rendering: 'background',
                color: '#5e72e4'
            }, {
                id: 'availableForMeeting',
                start: '2021-03-13T10:00:00',
                end: '2021-03-13T16:00:00',
                rendering: 'background'
            },
            // red areas where no events can be dropped
            {
                start: '2021-03-24',
                end: '2021-03-28',
                overlap: false,
                rendering: 'background',
                color: 'rgba(0,0,0,0.1)'
            }, {
                start: '2021-03-06',
                end: '2021-03-11',
                overlap: false,
                rendering: 'background',
                color: 'rgba(0,0,0,0.1)'
            }
        ]
    });

    calendar.render();
});

//LIST FULLCALENDAR
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek'
        },

        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            listDay: { buttonText: 'list day' },
            listWeek: { buttonText: 'list week' }
        },
        initialView: 'listWeek',
        initialDate: '2021-07-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        dayMaxEvents: true, // allow "more" link when too many events
        events: [{
            title: 'All Day Event',
            start: '2021-11-01'
        }, {
            title: 'Long Event',
            start: '2019-11-07',
            end: '2021-03-10'
        }, {
            id: 999,
            title: 'Repeating Event',
            start: '2021-11-09T16:00:00'
        }, {
            id: 999,
            title: 'Repeating Event',
            start: '2021-11-16T16:00:00'
        }, {
            title: 'Conference',
            start: '2019-11-11',
            end: '2021-11-13'
        }, {
            title: 'Meeting',
            start: '2019-11-12T10:30:00',
            end: '2021-11-12T12:30:00'
        }, {
            title: 'Lunch',
            start: '2021-11-12T12:00:00'
        }, {
            title: 'Meeting',
            start: '2021-11-12T14:30:00'
        }, {
            title: 'Happy Hour',
            start: '2021-11-12T17:30:00'
        }, {
            title: 'Dinner',
            start: '2021-11-12T20:00:00'
        }, {
            title: 'Birthday Party',
            start: '2021-11-13T07:00:00'
        }, {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2021-11-28'
        }]
    });

    calendar.render();
});