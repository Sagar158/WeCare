@php
    $route = (!isset($appointment->id) ? route('appointments.store') : route('appointments.update',$appointment->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Appointment') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    @if(auth()->user()->user_type_id == '3')
                        <x-text-input id="patient_id" type="hidden" name="patient_id" :value="old('patient_id', auth()->user()->id)" required autofocus autocomplete="off"/>
                    @else
                        <div class="col-lg-4 col-sm-12 col-md-4">
                            <x-select-box id="patient_id" name="patient_id" :value="old('patient_id', $appointment->patient_id)" :values="\App\Helpers\Helper::fetchPatients()" autocomplete="off" placeholder="Patient Name" />
                        </div>
                    @endif
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="appointment_date" type="date" name="appointment_date" :value="old('appointment_date', $appointment->appointment_date)" required autofocus autocomplete="off" placeholder="Appointment Date" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="appointment_time" type="time" name="appointment_time" :value="old('appointment_time', $appointment->appointment_time)" required autofocus autocomplete="off" placeholder="Appointment Time" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="type" name="type" :value="old('type', $appointment->type)" :values="\App\Helpers\Helper::$type" autocomplete="off" placeholder="Type" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="healthcare_id" name="healthcare_id" :value="old('healthcare_id', $appointment->healthcare_id)" :values="\App\Helpers\Helper::fetchHealthCare()" autocomplete="off" placeholder="Health Care" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="specialization_id" name="specialization_id" :value="old('specialization_id', $appointment->specialization_id)" extraClass="ajax-endpoint" endpoint="{{ route('healthcare.doctor.specialization') }}" autocomplete="off" placeholder="Specializations" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="doctor_id" name="doctor_id" :value="old('doctor_id', $appointment->doctor_id)" extraClass="ajax-endpoint" endpoint="{{ route('doctors.fetch.withspecialization') }}" autocomplete="off" placeholder="Doctor" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="reason" type="text" name="reason" :value="old('reason', $appointment->reason)" autofocus autocomplete="off" placeholder="Reason" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>

            $(document).ready(function() {
                $('.tinymceExample').summernote({
                    height: 300
                });

                $(document).on('change','select[name="healthcare_id"]', function(){
                    var healthCareId = $(this).val();
                    $('select[name="specialization_id"]').attr('data-field1-id', healthCareId);
                    refreshSelectBox();
                });

                $(document).on('change','select[name="specialization_id"]', function(){
                    var specializationId = $(this).val();
                    $('select[name="doctor_id"]').attr('data-field1-id', specializationId);
                    refreshSelectBox();
                });

            });
        </script>
    @endpush
</x-app-layout>
