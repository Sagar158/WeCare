<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Specialization)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $specializations }}</a></h3>
                          </div>
                        </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Doctors)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $doctors }}</a></h3>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Health Care)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $healthCare }}</a></h3>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Appointments)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $appointments }}</a></h3>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Traffic Post)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $trafficPosts }}</a></h3>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3 p-2 m-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                          <h6 class="card-title mb-0">Total - <span class="text-success">(Medical Post)</span></h6>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-12 col-xl-12">
                            <h3 class="mb-2"><a href="#">{{ $medicalPosts }}</a></h3>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
