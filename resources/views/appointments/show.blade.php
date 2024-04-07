<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Appointment Details') }}"></x-page-heading>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    @if(in_array(auth()->user()->user_type_id , [2, 1]))
                        <x-select-box id="status" name="status" :value="old('status', $appointment->status)" :values="\App\Models\Appointments::$status" autocomplete="off" placeholder="Appointment Status" />
                    @else
                        @if($appointment->status == 'pending')
                            <button class="btn btn-danger cancel-appointment">Cancel Appointment</button>
                        @endif
                    @endif
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Patient Name </th>
                                    <td>{{ $appointment->patient->fullname }}</td>
                                </tr>
                                <tr>
                                    <th>Patient Contact </th>
                                    <td>{{ $appointment->patient->contact_number }}</td>
                                </tr>
                                <tr>
                                    <th>Doctor</th>
                                    <td>{{ $appointment->doctor->name }}</td>
                                </tr>
                                <tr>
                                    <th>Specialization</th>
                                    <td>{{ $appointment->specialization->name }}</td>
                                </tr>
                                <tr>
                                    <th>Appointment Date</th>
                                    <td>{{ date('F j, Y', strtotime($appointment->appointment_date)) }}</td>
                                </tr>
                                <tr>
                                    <th>Appointment Time</th>
                                    <td>{{ date('h:i a', strtotime($appointment->appointment_time)) }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ Str::ucfirst($appointment->type) }}</td>
                                </tr>
                                <tr>
                                    <th>Health Care Center</th>
                                    <td>{{ $appointment->healthcare->name }}</td>
                                </tr>
                                <tr>
                                    <th>Health Care Address</th>
                                    <td>{{ $appointment->healthcare->institute_address }}</td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td>{!! $appointment->reason !!}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ Str::ucfirst($appointment->status) }}</td>
                                </tr>
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
            $(document).ready(function(){
                $(document).on('change','select[name="status"]',function(){
                    var status = $(this).val();
                    var appointmentId = '{{ $appointment->id }}';
                    changeStatus(status, appointmentId);
                });

                function changeStatus(status, appointmentId)
                {
                    $.ajax({
                                url: '{{ route("appointments.changeStatus") }}',
                                method: 'POST',
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    status : status,
                                    appointmentId : appointmentId,
                                },
                                success: function(response)
                                {

                                    if(response.success == 1)
                                    {
                                        Swal.fire({
                                                title: "Updated!",
                                                text: "Appointment has been changed",
                                                icon: "success"
                                                });
                                        location.reload();
                                    }
                                    else
                                    {
                                        Swal.fire({
                                                title: "OOPS!",
                                                text: "Something went wrong",
                                                icon: "error"
                                                });
                                    }
                                }
                    });
                }
                $(document).on('click','.cancel-appointment', function(){
                    var appointmentId = '{{ $appointment->id }}';
                    var status = 'cancelled';
                    changeStatus(appointmentId, status);
                });
            });
        </script>
    @endpush
</x-app-layout>
