<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Appointments') }}"></x-page-heading>
        <x-right-side-button link="{{ route('appointments.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>Patient Name</th>
                              <th>Appointment Date/Time</th>
                              <th>Health Care Center</th>
                              <th>Health Care Address</th>
                              <th>Doctor</th>
                              <th>Appointment Type</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("appointments.getAppointmentsData") }}',
                    columns: [
                        { data: 'patient_name', name: 'patient_name' },
                        { data: 'appointment_date_time', name: 'appointment_date_time' },
                        { data: 'healthcare_center', name: 'healthcare_center' },
                        { data: 'healthcare_address', name: 'healthcare_address' },
                        { data: 'doctor', name: 'doctor' },
                        { data: 'type', name: 'type' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
