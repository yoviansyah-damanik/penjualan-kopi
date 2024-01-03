<header class="header-area">
    <div id="home" class="header-hero"
        style="background-image: url({{ asset('frontend-assets/images/banner-bg.svg') }})">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-2/3">
                    <div class="pt-32 mb-12 text-center lg:pt-48 header-hero-content">
                        <h3 class="text-3xl font-light leading-tight text-white lg:text-4xl header-sub-title wow fadeInUp"
                            data-wow-duration="1.3s" data-wow-delay="0.2s">
                            {{ config('app.name') }}
                        </h3>
                        <h2 class="mb-3 text-xl font-bold text-white lg:text-4xl header-title wow fadeInUp"
                            data-wow-duration="1.3s" data-wow-delay="0.5s">
                            {{ __('Enjoy a cup of coffee brewed with high quality coffee beans') }}
                        </h2>
                        <p class="mb-8 text-white text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">
                            {{ __('Now you can order coffee according to your wishes without any hassle') }}
                        </p>
                        <a href="{{ Auth::check() ? route('product') : route('login') }}"
                            class="main-btn bg-gradient-to-br from-pink-950 to-red-800 wow fadeInUp"
                            data-wow-duration="1.3s" data-wow-delay="1.1s">
                            {{ __('Get Started') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="justify-center row">
                <div class="w-full lg:w-2/3">
                    <div class="text-center header-hero-image wow fadeIn" data-wow-duration="1.3s"
                        data-wow-delay="1.4s">
                        <img src="{{ asset('frontend-assets/images/header-hero.png') }}" alt="hero">
                    </div>
                </div>
            </div>
        </div>
        <div id="particles-1" class="particles"></div>
    </div>
</header>
