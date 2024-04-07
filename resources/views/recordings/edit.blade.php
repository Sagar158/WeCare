@php
    $route = (!isset($recording->id) ? route('recordings.store') : route('recordings.update',$recording->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Recording') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="appointment_id" name="appointment_id" :value="old('appointment_id', $recording->appointment_id)" :values="\App\Helpers\Helper::fetchCompletedAppointments()" autocomplete="off" placeholder="Appointment Number" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="recording" name="recording" type="file" :value="old('recording', $recording->recording)" autocomplete="off" placeholder="Recording" />
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
        });
    </script>
    @endpush
</x-app-layout>
