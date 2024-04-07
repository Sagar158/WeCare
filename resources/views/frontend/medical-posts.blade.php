<x-front-layout>
    <section id="traffic_posts" class="traffic_posts">
        <div class="container">

          <div class="section-title">
            <h2>Medical Posts</h2>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 pb-5">
                <h3 style="font-weight: bold !important; ">Medical Posts</h3>
            </div>
            @if(!empty($posts))
                @foreach ($posts as $post)
                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset($post->image) }}" style="width: 100px; height:100px;" class="img-fluid" alt=""></div>
                    <div class="member-info" style="padding-left:20px; ">
                        <h4><a href="{{ route('medicalPost', $post->id) }}">{{ $post->title }}</a></h4>
                        <p>{{ substr(strip_tags($post->description),0, 80) }}</p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
          </div>

        </div>
      </section>
</x-front-layout>
