<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Health Care') }}"></x-page-heading>
        <x-right-side-button link="{{ route('healthcare.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Institute Address</th>
                              <th>Contact Number</th>
                              <th>Opening Hours</th>
                              <th>Closing Hours</th>
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
                    ajax: '{{ route("healthcare.getHealthCareData") }}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'institute_address', name: 'institute_address' },
                        { data: 'contact_number', name: 'contact_number' },
                        { data: 'opening_hours', name: 'opening_hours' },
                        {data: 'closing_hours', name: 'closing_hours'},
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
