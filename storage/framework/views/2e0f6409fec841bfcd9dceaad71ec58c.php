
<div class="mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-0">
                    <i class="text-muted me-2">📅</i>Appointment Calendar
                </h5>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary" id="calendarToday">Today</button>
                    <button type="button" class="btn btn-outline-primary" id="calendarPrev">‹</button>
                    <button type="button" class="btn btn-outline-primary" id="calendarNext">›</button>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div id="appointment-calendar"></div>
        </div>
        <div class="card-footer bg-white border-top">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <span class="badge bg-warning text-dark px-3 py-2">
                    <span style="font-size: 10px;">●</span> Pending
                </span>
                <span class="badge bg-success px-3 py-2">
                    <span style="font-size: 10px;">●</span> Confirmed
                </span>
                <span class="badge bg-info px-3 py-2">
                    <span style="font-size: 10px;">●</span> Completed
                </span>
                <span class="badge bg-danger px-3 py-2">
                    <span style="font-size: 10px;">●</span> Cancelled
                </span>
                <span class="badge bg-secondary px-3 py-2">
                    <span style="font-size: 10px;">●</span> Declined
                </span>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('head'); ?>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <style>
        #appointment-calendar {
            min-height: 600px;
        }

        .fc-event {
            cursor: pointer !important;
            border: none !important;
            padding: 2px 4px;
            font-size: 0.8rem;
            transition: all 0.2s ease;
        }

        .fc-event:hover {
            opacity: 0.85;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .fc-daygrid-event {
            margin-bottom: 2px;
            border-radius: 4px;
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            font-weight: 600;
            color: #2c3e50;
        }

        .fc-button {
            text-transform: capitalize !important;
            border-radius: 6px !important;
        }

        .fc-day-today {
            background-color: rgba(13, 110, 253, 0.08) !important;
        }

        .fc-timegrid-slot {
            height: 3em;
        }

        .fc-col-header-cell {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 10px 0;
        }

        .fc-event-title {
            font-weight: 500;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        let appointmentCalendar;

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('appointment-calendar');
            if (!calendarEl) {
                console.error('Calendar element not found!');
                return;
            }

            // Parse events from Laravel - CRITICAL FIX
            let calendarEvents = [];
            try {
                calendarEvents = <?php echo json_encode($events ?? [], 15, 512) ?>;
                console.log('Calendar events loaded:', calendarEvents.length);
            } catch (e) {
                console.error('Failed to parse calendar events:', e);
            }

            // Initialize FullCalendar
            appointmentCalendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List'
                },
                events: calendarEvents,
                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    const appointmentId = info.event.extendedProps.appointmentId;
                    console.log('Event clicked, ID:', appointmentId);

                    if (appointmentId) {
                        openEditModal(appointmentId);
                    }
                },
                eventDidMount: function(info) {
                    // Add rich tooltip
                    const props = info.event.extendedProps;
                    const startTime = new Date(info.event.start).toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const tooltipHtml = `
                <div style="max-width: 250px;">
                    <strong>${info.event.title}</strong><br>
                    <small>
                        👤 ${props.booker} → ${props.target}<br>
                        ${props.company ? '🏢 ' + props.company + '<br>' : ''}
                        📍 ${props.location}<br>
                        ⏰ ${startTime} (${props.duration} min)<br>
                        <span class="badge bg-${getStatusBadge(props.status)} mt-1">${props.status.toUpperCase()}</span>
                    </small>
                </div>
            `;

                    // Bootstrap tooltip
                    info.el.setAttribute('data-bs-toggle', 'tooltip');
                    info.el.setAttribute('data-bs-html', 'true');
                    info.el.setAttribute('data-bs-placement', 'top');
                    info.el.setAttribute('title', tooltipHtml);

                    // Initialize tooltip
                    if (typeof bootstrap !== 'undefined') {
                        new bootstrap.Tooltip(info.el);
                    }
                },
                height: 'auto',
                slotMinTime: '07:00:00',
                slotMaxTime: '21:00:00',
                allDaySlot: false,
                nowIndicator: true,
                navLinks: true,
                selectable: true,
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5],
                    startTime: '08:00',
                    endTime: '18:00',
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                }
            });

            // Render calendar
            appointmentCalendar.render();
            console.log('Calendar rendered successfully');

            // Navigation buttons
            document.getElementById('calendarToday')?.addEventListener('click', function() {
                appointmentCalendar.today();
            });

            document.getElementById('calendarPrev')?.addEventListener('click', function() {
                appointmentCalendar.prev();
            });

            document.getElementById('calendarNext')?.addEventListener('click', function() {
                appointmentCalendar.next();
            });
        });

        /**
         * Open edit modal for appointment
         */
        function openEditModal(appointmentId) {
            console.log('Opening modal for appointment:', appointmentId);

            // Method 1: Find existing modal link and trigger it
            const existingLink = document.querySelector('[data-async-route*="asyncGetAppointment"]');

            if (existingLink) {
                // Clone and modify
                const link = existingLink.cloneNode(true);
                link.setAttribute('data-async-parameters', JSON.stringify({appointment: appointmentId}));
                link.click();
                return;
            }

            // Method 2: Create new link programmatically
            const tempLink = document.createElement('a');
            tempLink.setAttribute('data-turbo-method', 'get');
            tempLink.setAttribute('data-turbo', 'true');
            tempLink.setAttribute('data-modal', 'editAppointmentModal');
            tempLink.setAttribute('data-modal-title', 'Edit Appointment');
            tempLink.setAttribute('data-async-route', window.location.pathname + '/async/asyncGetAppointment');
            tempLink.setAttribute('data-async-parameters', JSON.stringify({appointment: appointmentId}));
            tempLink.style.display = 'none';
            document.body.appendChild(tempLink);

            // Trigger click
            setTimeout(() => {
                tempLink.click();
                setTimeout(() => {
                    document.body.removeChild(tempLink);
                }, 100);
            }, 10);
        }

        /**
         * Get badge color class for status
         */
        function getStatusBadge(status) {
            const badges = {
                'confirmed': 'success',
                'pending': 'warning',
                'cancelled': 'danger',
                'completed': 'info',
                'declined': 'secondary'
            };
            return badges[status] || 'light';
        }

        /**
         * Refresh calendar after updates
         */
        function refreshCalendar() {
            if (appointmentCalendar) {
                location.reload();
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.appointment.modal-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/admin/appointment/calendar.blade.php ENDPATH**/ ?>