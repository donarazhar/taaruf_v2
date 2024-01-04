@extends('dashboard.dashlayouts.style')
<div class="page-content-wrapper py-3">
    <div class="container">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile me-3"><img src="img/icons/ACoding.png" alt="">
                    <form action="#">
                        <input class="form-control" type="file">
                    </form>
                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">AC</h5><span class="badge bg-warning ms-2 rounded-pill">Pro</span>
                    </div>
                    <p class="mb-0">Animation Bro</p>
                </div>
            </div>
        </div>
        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                <form action="#">
                    <div class="form-group mb-3">
                        <label class="form-label" for="Username">Username</label>
                        <input class="form-control" id="Username" type="text" value="@designing-world"
                            placeholder="Username">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="fullname">Full Name</label>
                        <input class="form-control" id="fullname" type="text" value="AC" placeholder="Full Name"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email Address</label>
                        <input class="form-control" id="email" type="text" value="care@example.com"
                            placeholder="Email Address" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="job">Job Title</label>
                        <input class="form-control" id="job" type="text" value="UX/UI Designer"
                            placeholder="Job Title">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="portfolio">Portfolio URL</label>
                        <input class="form-control" id="portfolio" type="url"
                            value="www.youtube.com/animationcoding" placeholder="Portfolio URL">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input class="form-control" id="address" type="text" value="28/C Green Road, BD"
                            placeholder="Address">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" cols="30" rows="10"
                            placeholder="Working as UX/UI Designer at Designing World since 2016."></textarea>
                    </div>
                    <button class="btn btn-success w-100" type="submit">Update Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
