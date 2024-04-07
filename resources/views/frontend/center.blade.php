<x-front-layout>

    <section class="why-us">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12 d-flex align-items-stretch mt-5">
                    <h3 class="pl-2 font-weight-bold" style="font-weight: bold; padding-left:20px;">{{ $center->name }} - ({{ $center->institute_address }})</h3>
                </div>
                <div class="col-lg-9 col-sm-12 col-md-9 mt-3">
                    <p>{!! $center->history !!}</p>
                </div>
                <div class="col-lg-3 col-sm-10 col-md-3 mt-3">
                    <h5 style="font-weight:bold;">{{ $center->name }} Timing</h5>
                    <ul>
                        @if(!empty($fetchOpenDays))
                            @foreach($fetchOpenDays as $day)
                                <li>{{ $day }}</li>
                            @endforeach
                        @endif
                    </ul>

                    <h5 style="font-weight:bold;">Specialization</h5>
                    <ul>
                        @if(isset($center->specializations))
                            @foreach($center->specializations as $specialization)
                                <li>{{ $specialization->name }}</li>

                            @endforeach
                        @endif
                    </ul>
                    <h5 style="font-weight: bold;">Contact Number</h5>
                    <h6>
                        <ul>
                            <li>
                                <a href="tel:{{ $center->contact_number }}">{{ $center->contact_number }}</a>
                            </li>
                        </ul>
                    </h6>
                    <h5 style="font-weight: bold;">Address</h5>
                    <h6>
                        <ul>
                            <li>{{ $center->institute_address }}</li>
                        </ul>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
    <div class="container">

        <div class="section-title">
            <h2>Doctors</h2>
        </div>

        <div class="row">
            @if(!empty($center->doctors))
                @foreach($center->doctors as $doctor)
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
        </div>

    </div>
    </section><!-- End Doctors Section -->

    <section class="why-us">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    {!! $center->map_link !!}
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
