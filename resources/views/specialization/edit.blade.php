@php
    $route = (!isset($specialization->id) ? route('specialization.store') : route('specialization.update',$specialization->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Specialization') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $specialization->name)" required autofocus autocomplete="off" placeholder="Name" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="description" type="text" name="description" :value="old('description', $specialization->description)" autofocus autocomplete="off" placeholder="Description" />
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
