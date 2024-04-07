<x-front-layout>
    <section id="traffic_posts" class="traffic_posts">
        <div class="container">

          <div class="section-title">
            <h2>Traffic Posts</h2>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 pb-5">
                <h3 style="font-weight: bold !important;">Traffic Posts</h3>
            </div>
            @if(!empty($posts))
                @foreach ($posts as $traffic)
                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset($traffic->image) }}" style="width: 100px; height:100px;" class="img-fluid" alt=""></div>
                    <div class="member-info" style="padding-left:20px; ">
                        <h4><a href="{{ route('trafficPost', $traffic->id) }}">{{ $traffic->title }}</a></h4>
                        <p>{{ substr(strip_tags($traffic->description),0, 80) }}</p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
          </div>

        </div>
      </section>
</x-front-layout>
