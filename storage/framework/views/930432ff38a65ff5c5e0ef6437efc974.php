<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 Booking modal script loaded');

        // Wait for modal to be ready
        const bookingModal = document.getElementById('bookMeetingModal');

        if (bookingModal) {
            bookingModal.addEventListener('shown.bs.modal', function() {
                console.log('📅 Modal opened');
                initializeBookingForm();
            });

            // Also initialize on page load if modal is already open
            if (bookingModal.classList.contains('show')) {
                initializeBookingForm();
            }
        }

        function initializeBookingForm() {
            console.log('🔧 Initializing booking form');

            // Get the company filter select
            const companyFilter = document.querySelector('[name="filter_company_id"]');
            const exhibitorSelect = document.getElementById('target_user_select');
            const exhibitorHidden = document.getElementById('target_user_id_hidden');

            if (!companyFilter || !exhibitorSelect) {
                console.error('❌ Required elements not found');
                return;
            }

            console.log('✅ Elements found');

            // Load all exhibitors on initial load
            loadExhibitors();

            // Listen for company filter changes
            companyFilter.addEventListener('change', function() {
                const companyId = this.value;
                console.log('🏢 Company changed:', companyId);
                loadExhibitors(companyId);
            });

            // Update hidden field when exhibitor is selected
            exhibitorSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                console.log('👤 Exhibitor selected:', selectedValue);
                if (exhibitorHidden) {
                    exhibitorHidden.value = selectedValue;
                }
            });
        }

        function loadExhibitors(companyId = '') {
            const exhibitorSelect = document.getElementById('target_user_select');

            if (!exhibitorSelect) {
                console.error('❌ Exhibitor select not found');
                return;
            }

            console.log('📥 Loading exhibitors for company:', companyId || 'all');

            // Show loading state
            exhibitorSelect.innerHTML = '<option value="">Loading exhibitors...</option>';
            exhibitorSelect.disabled = true;

            // Build URL with company filter
            const url = '/admin/appointments/get-exhibitors' + (companyId ? `?company_id=${companyId}` : '');
            console.log('🌐 Fetching from:', url);

            // Fetch exhibitors
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
                .then(response => {
                    console.log('📡 Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ Data received:', data);

                    if (data.status === 'success' && data.data) {
                        // Clear existing options
                        exhibitorSelect.innerHTML = '<option value="">Select exhibitor...</option>';

                        // Add exhibitors
                        data.data.forEach(exhibitor => {
                            const option = document.createElement('option');
                            option.value = exhibitor.id;
                            option.textContent = exhibitor.name;
                            exhibitorSelect.appendChild(option);
                        });

                        console.log(`✅ Loaded ${data.data.length} exhibitors`);
                    } else {
                        exhibitorSelect.innerHTML = '<option value="">No exhibitors found</option>';
                        console.warn('⚠️ No exhibitors in response');
                    }

                    exhibitorSelect.disabled = false;
                })
                .catch(error => {
                    console.error('❌ Error loading exhibitors:', error);
                    exhibitorSelect.innerHTML = '<option value="">Error loading exhibitors</option>';
                    exhibitorSelect.disabled = false;

                    // Show user-friendly error
                    alert('Failed to load exhibitors. Please refresh the page and try again.');
                });
        }
    });
</script>
<?php /**PATH /home/runner/work/EventsManager/EventsManager/resources/views/admin/appointment/modal-scripts.blade.php ENDPATH**/ ?>