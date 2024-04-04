@php
    $route = (!isset($doctor->id) ? route('doctors.store') : route('doctors.update',$doctor->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Doctor') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $doctor->name)" required autofocus autocomplete="off" placeholder="Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="experience" type="number" name="experience" :value="old('experience', $doctor->experience)" required autofocus autocomplete="off" placeholder="Experience (In Years)" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="health_care_id" name="health_care_id" :value="old('health_care_id', $doctor->health_care_id)" :values="\App\Helpers\Helper::fetchHealthCare()" autocomplete="off" placeholder="Health Care" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="specialization_id" name="specialization_id" field1="{{ isset($doctor->health_care_id) ? $doctor->health_care_id : '' }}" :value="old('specialization_id', $doctor->specialization_id)" extraClass="ajax-endpoint" endpoint="{{ route('healthcare.doctor.specialization') }}" autocomplete="off" placeholder="Specializations" optionText="{{ (isset($doctor->specialization_id)) ? \App\Models\Specializations::findorFail($doctor->specialization_id)->name : (request()->get('specialization_id') ? \App\Models\Specializations::findorFail(request()->get('specialization_id'))->name : '' ) }}"/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <input type="file" id="myDropify" name="image" class="border"/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="description" type="text" name="description" :value="old('description', $doctor->description)" autofocus autocomplete="off" placeholder="Description" />
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
            $(document).ready(function(){
                @if(isset($doctor->image))
                    $('.dropify-render').html('<img src="{{ asset($doctor->image) }}">')
                    $('.dropify-preview').css('display','block');
                @endif

                $(document).on('change','select[name="health_care_id"]', function(){
                    var healthCareId = $(this).val();
                    $('select[name="specialization_id"]').attr('data-field1-id', healthCareId);
                    refreshSelectBox();
                });
            });
            $(document).ready(function() {
                $('.tinymceExample').summernote({
                    height: 300
                });
            });
        </script>
    @endpush
</x-app-layout>
