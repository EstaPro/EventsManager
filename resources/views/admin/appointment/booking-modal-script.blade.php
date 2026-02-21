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
                console.log('Company filter:', companyFilter);
                console.log('Exhibitor select:', exhibitorSelect);
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
            const baseUrl = window.location.origin + '/admin/appointments/get-exhibitors';
            const url = companyId ? `${baseUrl}?company_id=${companyId}` : baseUrl;
            console.log('🌐 Fetching from:', url);

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            // Fetch exhibitors
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin'
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
                    console.error('Failed to load exhibitors. Please check the console for details.');
                });
        }
    });
</script>
