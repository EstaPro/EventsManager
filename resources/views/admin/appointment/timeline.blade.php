<div class="bg-white rounded shadow-sm p-4">
    <h4 class="mb-4"><i class="bi bi-clock-history"></i> Meeting Timeline</h4>

    @if($appointments->count() > 0)
        <div class="timeline">
            @foreach($appointments as $appointment)
                <div class="timeline-item mb-4">
                    <div class="d-flex">
                        <div class="timeline-marker me-3">
                            @php
                                $iconClass = match($appointment->status) {
                                    'confirmed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    'completed' => 'bg-primary',
                                    default => 'bg-warning',
                                };
                            @endphp
                            <div class="rounded-circle {{ $iconClass }} d-flex align-items-center justify-content-center text-white"
                                 style="width: 40px; height: 40px;">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                        <div class="timeline-content flex-grow-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0">
                                            {{ $appointment->booker->name ?? 'Unknown' }}
                                            <i class="bi bi-arrow-right-short"></i>
                                            {{ $appointment->targetUser->name ?? 'Unknown' }}
                                        </h6>
                                        @php
                                            $badgeClass = match($appointment->status) {
                                                'confirmed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                'completed' => 'bg-primary',
                                                default => 'bg-warning text-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($appointment->status) }}</span>
                                    </div>
                                    <div class="small text-muted mb-2">
                                        <i class="bi bi-building"></i> {{ $appointment->targetUser->company->name ?? 'N/A' }}
                                    </div>
                                    <div class="small">
                                        <i class="bi bi-clock"></i> {{ $appointment->scheduled_at?->format('M d, Y H:i') ?? 'Not scheduled' }}
                                        @if($appointment->duration_minutes)
                                            <span class="text-muted">({{ $appointment->duration_minutes }} min)</span>
                                        @endif
                                    </div>
                                    @if($appointment->table_location)
                                        <div class="small mt-1">
                                            <i class="bi bi-geo-alt"></i> {{ $appointment->table_location }}
                                        </div>
                                    @endif
                                    @if($appointment->notes)
                                        <div class="small mt-2 text-muted">
                                            <i class="bi bi-sticky"></i> {{ Str::limit($appointment->notes, 100) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="text-center text-muted py-5">
            <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
            <p class="mt-3">No meetings found</p>
        </div>
    @endif
</div>

<style>
    .timeline {
        position: relative;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
        bottom: 0;
        width: 2px;
        background: #dee2e6;
    }
    .timeline-item:last-child .timeline-content::before {
        display: none;
    }
</style>
