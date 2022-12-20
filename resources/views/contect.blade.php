@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Contect Us</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Contect Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.3562273371135!2d72.8845013760921!3d21.217718181260192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f7a8c3597a5%3A0x4dd5cae79ce55a96!2sHit%20Infotech%20LLP!5e0!3m2!1sen!2sin!4v1671095924599!5m2!1sen!2sin" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        @php 
                            $infos = explode('/',$settings['contect_address']);
                        @endphp
                        @if($settings['show_contect_form'])
                            <ul class="">
                                @foreach($infos as $key => $info)
                                    @if($info != '')
                                        @php $data = explode(':',$info);  @endphp
                                        <li>
                                            <h4>{{ $data[0] }}</h4>
                                            <p>{{ $data[1] }} <br />{{ $data[2] }} <br>{{ $data[3] }}</p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                @if($settings['show_contect_form'])
                        <div class="contact__form">
                            <form action="{{ route('front.contect.form') }}" action="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="Name" class="@error('Name') is-invalid @enderror" placeholder="Name" value="{{@old('Name')}}">
                                        @error('Name') 
                                            <small class="text-danger">*Please Input Name</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="Email" class="@error('Email') is-invalid @enderror" placeholder="Email" value="{{@old('Email')}}">
                                        @error('Email') 
                                            <small class="text-danger">*Please Input Valid Email</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Message" name="Message" class="@error('Message') is-invalid @enderror">{{@old('Message')}}</textarea>
                                        @error('Message') 
                                            <small class="text-danger">*Please Add Some Text</small>
                                        @enderror
                                        <button type="submit" class="site-btn">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        @foreach($infos as $key => $info)
                            @if($info != '')
                                @php $data = explode(':',$info);  @endphp
                                <div>
                                    <h4>{{ $data[0] }}</h4>
                                    <p>{{ $data[1] }} <br />{{ $data[2] }} <br>{{ $data[3] }}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

@endsection
@section('home-script')
@endsection