<x-front-layout>
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
          <h1>Welcome to WeCare</h1>
          <h2>Good Health Is The Root Of All Happiness</h2>
        </div>
      </section><!-- End Hero -->
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

          <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="content">
                <h3>Why Choose WeCare?</h3>
                <p>
                    Our team is ready to assist you every step of the way. Choose your preferred date and time and start prioritizing your well-being today
                </p>
              </div>
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="icon-boxes d-flex flex-column justify-content-center">
                <div class="row">
                  <div class="col-xl-6 d-flex align-items-stretch">
                    <div class="icon-box mt-4 mt-xl-0">
                      <i class="bx bx-receipt"></i>
                      <h4>Good Health Is The Root Of All Happiness</h4>
                    </div>
                  </div>
                </div>
              </div><!-- End .content-->
            </div>
          </div>

        </div>
      </section><!-- End Why Us Section -->


      <!-- ======= Counts Section ======= -->
      <section id="counts" class="counts">
        <div class="container">

          <div class="row">

            <div class="col-lg-4 col-md-6">
              <div class="count-box">
                <i class="fas fa-user-md"></i>
                <span data-purecounter-start="0" data-purecounter-end="{{ count($doctors) }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Doctors</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <i class="far fa-hospital"></i>
                <span data-purecounter-start="0" data-purecounter-end="{{ count($specializations) }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Departments</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="fas fa-flask"></i>
                <span data-purecounter-start="0" data-purecounter-end="{{ count(\App\Helpers\Helper::fetchHealthCareCenters()) }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Health Care Labs</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Counts Section -->

      <!-- ======= Departments Section ======= -->
      <section id="departments" class="departments">
        <div class="container">

          <div class="section-title">
            <h2>Departments</h2>
          </div>

          <div class="row gy-4">
            <div class="col-lg-3">
              <ul class="nav nav-tabs flex-column">
                @if(!empty($specializations))
                    @foreach($specializations as $key => $specialization)
                        <li class="nav-item">
                            <a class="nav-link {{ $key == 0 ? 'active show' : '' }}" data-bs-toggle="tab" href="#{{ Str::slug($specialization->name) }}">{{ $specialization->name }}</a>
                        </li>
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="col-lg-9">
              <div class="tab-content">
                @if(!empty($specializations))
                    @foreach($specializations as $key => $specialization)
                        <div class="tab-pane {{ $key == 0 ? 'active show' : '' }}" id="{{ Str::slug($specialization->name) }}">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                <h3>{{ $specialization->name }}</h3>
                                    <p class="fst-italic">{!! $specialization->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
              </div>
            </div>
          </div>

        </div>
      </section><!-- End Departments Section -->

      <!-- ======= Doctors Section ======= -->
      <section id="doctors" class="doctors">
        <div class="container">

          <div class="section-title">
            <h2>Doctors</h2>
          </div>

          <div class="row">
            @if(!empty($doctors))
                @foreach ($doctors as $doctor)
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
      </section>

      <section id="traffic_posts" class="traffic_posts">
        <div class="container">

          <div class="section-title">
            <h2>Traffic Posts</h2>
          </div>

          <div class="row">
            @if(!empty($trafficPosts))
                @foreach ($trafficPosts as $traffic)
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
      <section id="medical_posts" class="medical_posts">
        <div class="container">

          <div class="section-title">
            <h2>Medical Posts</h2>
          </div>

          <div class="row">
            @if(!empty($medicalPosts))
                @foreach ($medicalPosts as $medical)
                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset($medical->image) }}" style="width: 100px; height:100px;" class="img-fluid" alt=""></div>
                    <div class="member-info" style="padding-left:20px; ">
                        <h4><a href="{{ route('medicalPost', $medical->id) }}">{{ $medical->title }}</a></h4>
                        <p>{{ substr(strip_tags($medical->description),0, 80) }}</p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
          </div>

        </div>
      </section>

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="container">
          <div class="row mt-5">

            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>

                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>

                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55s</p>
                </div>

              </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0">

            <form id="contactForm" action="{{ route('contact-us.store') }}" method="POST" role="form" class="php-email-form">
                {{ @csrf_field() }}
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>

            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->
</x-front-layout>
