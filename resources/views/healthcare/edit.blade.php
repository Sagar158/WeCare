@php
    $route = (!isset($healthcare->id) ? route('healthcare.store') : route('healthcare.update',$healthcare->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Health Care') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $healthcare->name)" required autofocus autocomplete="off" placeholder="Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="institute_address" type="text" name="institute_address" :value="old('institute_address', $healthcare->institute_address)" required autofocus autocomplete="off" placeholder="Institute Address" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="contact_number" type="text" name="contact_number" :value="old('contact_number', $healthcare->contact_number)" required autofocus autocomplete="off" placeholder="Contact Number" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="from_day" name="from_day" :value="old('from_day', $healthcare->from_day)" :values="\App\Helpers\Helper::$weekdays" autocomplete="off" placeholder="From Day" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="to_day" name="to_day" :value="old('to_day', $healthcare->to_day)" :values="\App\Helpers\Helper::$weekdays" autocomplete="off" placeholder="To Day" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="opening_hours" type="time" name="opening_hours" :value="old('opening_hours', $healthcare->opening_hours)" required autofocus autocomplete="off" placeholder="Opening Hours" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="closing_hours" type="time" name="closing_hours" :value="old('closing_hours', $healthcare->closing_hours)" required autofocus autocomplete="off" placeholder="Closing Hours" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="map_link" type="text" name="map_link" :value="old('map_link', $healthcare->map_link)" required autofocus autocomplete="off" placeholder="Map Embeded Link" />
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="specialization_id[]" name="specialization_id[]" multiple="true" extraClass="specializations" selectedValues="{{ isset($selectedSpecializations) ? $selectedSpecializations : '' }}" value="" :values="\App\Helpers\Helper::fetchSpecializations()" autocomplete="off" placeholder="Specializations" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="history" type="text" name="history" :value="old('history', $healthcare->history)" autofocus autocomplete="off" placeholder="History" />
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
        <script src="{{ asset('js/summernote.min.js') }}"></script>
        <script src="{{ asset('assets/js/tinymce.js') }}"></script>
        <script>
            $(document).ready(function(){
                @if(isset($doctor->image))
                    $('.dropify-render').html('<img src="{{ asset($doctor->image) }}">')
                    $('.dropify-preview').css('display','block');
                @endif
            });
            $(document).ready(function() {
                $('.tinymceExample').summernote({
                    height: 500
                });
            });
        </script>
    @endpush
</x-app-layout>
