<x-front-layout>
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container mt-5">

            <div class="section-title">
                <h2>Doctors With Specializations</h2>
            </div>

            <div class="row">
                @if(!empty($specializations))
                    @foreach($specializations as $specialization)
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-4">
                        <h3>{{ $specialization->name }}</h3>
                    </div>
                    @if(!empty($specialization->doctors))
                        @foreach ($specialization->doctors as $doctor)
                            <div class="col-lg-6">
                                <div class="member d-flex align-items-start">
                                <div class="pic"><img src="{{ asset($doctor->image) }}" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $doctor->name }}</h4>
                                    <span>{{ $doctor->specialization->name }}</span>
                                    <p>{{ substr(strip_tags($doctor->description), 30) }}</p>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @endforeach
                @endif
            </div>

        </div>
    </section><!-- End Doctors Section -->
</x-front-layout>
