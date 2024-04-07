@php
    $route = (!isset($medicalPost->id) ? route('medical.posts.store') : route('medical.posts.update',$medicalPost->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Medical Post') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="title" type="text" name="title" :value="old('title', $medicalPost->title)" required autofocus autocomplete="off" placeholder="Title" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <input type="file" id="myDropify" name="image" class="border"/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="description" type="text" name="description" :value="old('description', $medicalPost->description)" autofocus autocomplete="off" placeholder="Description" />
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
                @if(isset($medicalPost->image))
                    $('.dropify-render').html('<img src="{{ asset($medicalPost->image) }}">')
                    $('.dropify-preview').css('display','block');
                @endif
            });
            $(document).ready(function() {
                $('.tinymceExample').summernote({
                    height: 300
                });
            });
        </script>
    @endpush
</x-app-layout>
