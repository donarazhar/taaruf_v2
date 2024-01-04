@extends('dashboard.dashlayouts.style')
<div class="section">
    <!-- Hero Slides-->
    <div class="owl-carousel-one owl-carousel">
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/31.jpg')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="500ms">Build
                        with Bootstrap 5</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="500ms">
                        Build
                        fast, responsive sites with Bootstrap.</p><a class="btn btn-creative btn-warning" href="#"
                        data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Buy Now</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay" style="background-image: url('./apk/assets/img/bg-img/32.jpg')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        PWA
                        ready</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        Make
                        your website feel more like a native app.</p><a class="btn btn-creative btn-warning"
                        href="#" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Buy
                        Now</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay" style="background-image: url('./apk/assets/img/bg-img/33.jpg')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        Unique elements &amp; pages</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        Create your website in minutes, not weeks.</p><a class="btn btn-creative btn-warning"
                        href="#" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Buy
                        Now</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay" style="background-image: url('./apk/assets/img/bg-img/1.jpg')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        Dark &amp; rtl ready</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        You
                        can use Dark or RTL mode of your choice.</p><a class="btn btn-creative btn-warning"
                        href="#" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Buy
                        Now</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Tombol Tengah --}}
    <div class="py-4">
        <div class="container direction-rtl">
            <div class="row g-3">
                <div class="col-3">
                    <div class="feature-card text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/bootstrap.png"
                                alt="">
                        </div>
                        <p class="mb-0">Bootstrap 5</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/pwa.png" alt="">
                        </div>
                        <p class="mb-0">PWA ready</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/sass.png" alt="">
                        </div>
                        <p class="mb-0">Sass </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/pug.png" alt="">
                        </div>
                        <p class="mb-0">Pug</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/npm.png" alt="">
                        </div>
                        <p class="mb-0">npm</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><img src="./apk/assets/img/demo-img/gulp.png"
                                alt="">
                        </div>
                        <p class="mb-0">gulp.js</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><i class="bi bi-box-arrow-left text-primary"></i></div>
                        <p class="mb-0">RTL ready</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto"><i class="bi bi-moon text-dark"></i></div>
                        <p class="mb-0">Dark mode</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card bg-light mb-3 shadow-sm bg-primary direction-rtl">
                    <div class="card-body">
                        <h2 class="text-dark">Reusable elements</h2>
                        <p class="text-dark mb-4">More than 220+ reusable modern design elements. Just copy the
                            code and paste it on your desired page.</p><a class="btn btn-info"
                            href="elements.html">All
                            elements</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card bg-light mb-3 shadow-sm bg-primary direction-rtl">
                    <div class="card-body">
                        <h2 class="text-dark">Ready pages</h2>
                        <p class="text-dark mb-4">Already designed more than 35+ pages for your needs. Such as -
                            Authentication, Chats, eCommerce, Blog &amp; Miscellaneous pages.</p><a
                            class="btn btn-info" href="pages.html">All pages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Customer Review</h2>
                <div class="testimonial-slide owl-carousel testimonial-style3">
                    <!-- Single Testimonial Slide-->
                    <div class="single-testimonial-slide">
                        <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill"></i></span>
                            <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.
                            </h6><span class="d-block">Mrrickez, Themeforest</span>
                        </div>
                    </div>
                    <!-- Single Testimonial Slide-->
                    <div class="single-testimonial-slide">
                        <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill"></i></span>
                            <h6 class="mb-2">All complete, <br> great craft.</h6><span class="d-block">Mazatlumm,
                                Themeforest</span>
                        </div>
                    </div>
                    <!-- Single Testimonial Slide-->
                    <div class="single-testimonial-slide">
                        <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i
                                    class="bi bi-star-fill"></i></span>
                            <h6 class="mb-2">Awesome template! <br> Excellent support!</h6><span
                                class="d-block">Vguntars, Themeforest</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-3"></div>
</div>
