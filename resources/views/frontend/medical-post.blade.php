<x-front-layout>
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container mt-5">

            <div class="section-title">
                <h2>{{ $medical->title }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <img src="{{ asset($medical->image) }}" style="width: 100%; height:600px; padding:30px;" alt="">
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    {!! $medical->description !!}
                </div>
            </div>

        </div>
    </section><!-- End Doctors Section -->
</x-front-layout>
