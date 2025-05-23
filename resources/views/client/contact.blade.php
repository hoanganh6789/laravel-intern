@extends('client.layouts.master')
@section('title', 'Contact')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="demo4.html"><i class="icon-home"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Contact Us
            </li>
        </ol>
    </div>
</nav>

<div class="map mb-4" style="width: 100%; height: 800px;">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d369.4908133907067!2d105.69754283106079!3d21.023340490354474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1724964755018!5m2!1svi!2s"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<div class="container contact-us-container">
    <div class="contact-info">
        <div class="row">
            <div class="col-12">
                <h2 class="ls-n-25 m-b-1">
                    Contact Info
                </h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit. Sed imperdiet libero id nisi euismod, sed
                    porta est consectetur. Vestibulum auctor felis eget
                    orci semper vestibulum. Pellentesque ultricies nibh
                    gravida, accumsan libero luctus, molestie nunc.L
                    orem ipsum dolor sit amet, consectetur adipiscing
                    elit.
                </p>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="feature-box text-center">
                    <i class="sicon-location-pin"></i>
                    <div class="feature-box-content">
                        <h3>Address</h3>
                        <h5>16, thôn 1, xã Song Phương, huyện Hoài Đức, Hà Nội</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-box text-center">
                    <i class="fa fa-mobile-alt"></i>
                    <div class="feature-box-content">
                        <h3>Phone Number</h3>
                        <h5>0367253666</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-box text-center">
                    <i class="far fa-envelope"></i>
                    <div class="feature-box-content">
                        <h3>E-mail Address</h3>
                        <h5><a href="https://portotheme.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="bcccd3cec8d3fcccd3cec8d3c8d4d9d1d992dfd3d1">[hoang838604@gmail.com]</a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-box text-center">
                    <i class="far fa-calendar-alt"></i>
                    <div class="feature-box-content">
                        <h3>Working Days/Hours</h3>
                        <h5>Mon - Sun / 9:00AM - 8:00PM</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h2 class="mt-6 mb-2">Send Us a Message</h2>

            <form class="mb-0" action="contact.html#">
                <div class="form-group">
                    <label class="mb-1" for="contact-name">Your Name
                        <span class="required">*</span></label>
                    <input type="text" class="form-control" id="contact-name" name="contact-name" required />
                </div>

                <div class="form-group">
                    <label class="mb-1" for="contact-email">Your E-mail
                        <span class="required">*</span></label>
                    <input type="email" class="form-control" id="contact-email" name="contact-email" required />
                </div>

                <div class="form-group">
                    <label class="mb-1" for="contact-message">Your Message
                        <span class="required">*</span></label>
                    <textarea cols="30" rows="1" id="contact-message" class="form-control" name="contact-message"
                        required></textarea>
                </div>

                <div class="form-footer mb-0">
                    <button type="submit" class="btn btn-dark font-weight-normal">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <h2 class="mt-6 mb-1">Frequently Asked Questions</h2>
            <div id="accordion">
                <div class="card card-accordion">
                    <a class="card-header" href="contact.html#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Curabitur eget leo at velit imperdiet viaculis
                        vitaes?
                    </a>

                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur eget leo at velit
                            imperdiet varius. In eu ipsum vitae velit
                            congue iaculis vitae at risus. Nullam tortor
                            nunc, bibendum vitae semper a, volutpat eget
                            massa.</p>
                    </div>
                </div>

                <div class="card card-accordion">
                    <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                        Curabitur eget leo at velit imperdiet vague
                        iaculis vitaes?
                    </a>

                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur eget leo at velit
                            imperdiet varius. In eu ipsum vitae velit
                            congue iaculis vitae at risus. Nullam tortor
                            nunc, bibendum vitae semper a, volutpat eget
                            massa. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Integer
                            fringilla, orci sit amet posuere auctor,
                            orci eros pellentesque odio, nec
                            pellentesque erat ligula nec massa. Aenean
                            consequat lorem ut felis ullamcorper posuere
                            gravida tellus faucibus. Maecenas dolor
                            elit, pulvinar eu vehicula eu, consequat et
                            lacus. Duis et purus ipsum. In auctor mattis
                            ipsum id molestie. Donec risus nulla,
                            fringilla a rhoncus vitae, semper a massa.
                            Vivamus ullamcorper, enim sit amet consequat
                            laoreet, tortor tortor dictum urna, ut
                            egestas urna ipsum nec libero. Nulla justo
                            leo, molestie vel tempor nec, egestas at
                            massa. Aenean pulvinar, felis porttitor
                            iaculis pulvinar, odio orci sodales odio, ac
                            pulvinar felis quam sit.</p>
                    </div>
                </div>

                <div class="card card-accordion">
                    <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Curabitur eget leo at velit imperdiet viaculis
                        vitaes?
                    </a>

                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur eget leo at velit
                            imperdiet varius. In eu ipsum vitae velit
                            congue iaculis vitae at risus. Nullam tortor
                            nunc, bibendum vitae semper a, volutpat eget
                            massa.</p>
                    </div>
                </div>

                <div class="card card-accordion">
                    <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
                        Curabitur eget leo at velit imperdiet vague
                        iaculis vitaes?
                    </a>

                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur eget leo at velit
                            imperdiet varius. In eu ipsum vitae velit
                            congue iaculis vitae at risus. Nullam tortor
                            nunc, bibendum vitae semper a, volutpat eget
                            massa. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Integer
                            fringilla, orci sit amet posuere auctor,
                            orci eros pellentesque odio, nec
                            pellentesque erat ligula nec massa. Aenean
                            consequat lorem ut felis ullamcorper posuere
                            gravida tellus faucibus. Maecenas dolor
                            elit, pulvinar eu vehicula eu, consequat et
                            lacus. Duis et purus ipsum. In auctor mattis
                            ipsum id molestie. Donec risus nulla,
                            fringilla a rhoncus vitae, semper a massa.
                            Vivamus ullamcorper, enim sit amet consequat
                            laoreet, tortor tortor dictum urna, ut
                            egestas urna ipsum nec libero. Nulla justo
                            leo, molestie vel tempor nec, egestas at
                            massa. Aenean pulvinar, felis porttitor
                            iaculis pulvinar, odio orci sodales odio, ac
                            pulvinar felis quam sit.</p>
                    </div>
                </div>

                <div class="card card-accordion">
                    <a class="card-header collapsed" href="contact.html#" data-toggle="collapse"
                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseThree">
                        Curabitur eget leo at velit imperdiet varius
                        iaculis vitaes?
                    </a>

                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <p>Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Curabitur eget leo at velit
                            imperdiet varius. In eu ipsum vitae velit
                            congue iaculis vitae at risus. Nullam tortor
                            nunc, bibendum vitae semper a, volutpat eget
                            massa. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Integer
                            fringilla, orci sit amet posuere auctor,
                            orci eros pellentesque odio, nec
                            pellentesque erat ligula nec massa. Aenean
                            consequat lorem ut felis ullamcorper posuere
                            gravida tellus faucibus. Maecenas dolor
                            elit, pulvinar eu vehicula eu, consequat et
                            lacus. Duis et purus ipsum. In auctor mattis
                            ipsum id molestie. Donec risus nulla,
                            fringilla a rhoncus vitae, semper a massa.
                            Vivamus ullamcorper, enim sit amet consequat
                            laoreet, tortor tortor dictum urna, ut
                            egestas urna ipsum nec libero. Nulla justo
                            leo, molestie vel tempor nec, egestas at
                            massa. Aenean pulvinar, felis porttitor
                            iaculis pulvinar, odio orci sodales odio, ac
                            pulvinar felis quam sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-8"></div>
@endsection
