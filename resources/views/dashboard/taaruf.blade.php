@extends('dashboard.dashlayouts.style')
<div class="page-content-wrapper py-3">
    <div class="blog-wrapper direction-rtl">
        <div class="container">
            <div class="row g-3">
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">Business</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">16
                                Dec</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">A
                                collection of textile samples lay spread out on the table</a><a
                                class="btn btn-primary btn-sm" href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">Agency</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">13
                                Dec</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">One
                                morning, when Gregor Samsa woke from troubled dreams</a><a
                                class="btn btn-primary btn-sm" href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">Info</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">11
                                Dec</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">He
                                lay on his armour-like back</a><a class="btn btn-primary btn-sm"
                                href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">World</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">6
                                Dec</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">The
                                5 best review in Affan</a><a class="btn btn-primary btn-sm"
                                href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">Fashion</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">1
                                Dec</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">It
                                wasn't a dream. His room, a proper human room although</a><a
                                class="btn btn-primary btn-sm" href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
                <!-- Single Blog Card-->
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card position-relative shadow-sm"><img class="card-img-top"
                            src="{{ asset('apk/assets/img/bg-img/22.jpg') }}" alt=""><span
                            class="badge bg-warning text-dark position-absolute card-badge">Sports</span>
                        <div class="card-body"><span class="badge bg-danger rounded-pill mb-2 d-inline-block">25
                                Nov</span><a class="blog-title d-block mb-3 text-dark" href="page-blog-details.html">The
                                5 best review in Affan</a><a class="btn btn-primary btn-sm"
                                href="page-blog-details.html">Read More</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body p-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center pagination-one direction-rtl">
                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><svg
                                    width="16" height="16" viewBox="0 0 16 16" class="bi bi-chevron-left"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">9</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><svg
                                    width="16" height="16" viewBox="0 0 16 16" class="bi bi-chevron-right"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
