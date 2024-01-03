<footer id="footer" class="relative z-10 footer-area pt-120">
    <div class="footer-bg" style="background-image: url({{ asset('frontend-assets/images/footer-bg.svg') }});"></div>
    <div class="container">
        <div class="px-6 pt-10 pb-20 mb-12 bg-white rounded-lg shadow-xl md:px-12 subscribe-area wow fadeIn"
            data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="row">
                <div class="w-full">
                    <div class="lg:mt-12 subscribe-content">
                        <h2 class="text-2xl font-bold sm:text-4xl subscribe-title">
                            Terinspirasi dari secangkir kopi, bahwa dia tak pernah dusta atas nama rasa.
                            <span class="block font-normal">Kopi punya cerita, hitam tak selalu kotor, pahit tak harus
                                sedih.</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget pb-120">
            <div class="row">
                <div class="w-4/5 md:w-3/5 lg:w-2/6">
                    <div class="mt-12 footer-about wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <a class="inline-block mb-8 logo" href="{{ route('home') }}" wire:navigate>
                            <img src="{{ Vite::image('logo.png') }}" alt="logo" class="w-40">
                        </a>
                        <p class="pb-10 pr-10 text-2xl font-bold leading-snug text-white ps-4">
                            Sejak 1983
                        </p>
                        <ul class="flex footer-social">
                            <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="w-4/5 sm:w-2/3 md:w-3/5 lg:w-2/6">
                    <div class="row">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
                            <div class="mt-12 link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="footer-title">
                                    <h4 class="mb-8 text-2xl font-bold text-white">{{ __('Menu') }}</h4>
                                </div>
                                <ul class="link">
                                    <li>
                                        <a class="page-scroll" href="{{ route('home') }}"
                                            wire:navigate>{{ __('Home') }}</a>
                                    </li>
                                    <li>
                                        <a class="page-scroll" href="{{ route('product') }}"
                                            wire:navigate>{{ __('Products') }}</a>
                                    </li>
                                    <li>
                                        <a class="page-scroll" href="{{ route('about') }}"
                                            wire:navigate>{{ __('About Us') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
                            <div class="mt-12 link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="footer-title">
                                    <h4 class="mb-8 text-2xl font-bold text-white">
                                        {{ __('Quick Link') }}
                                    </h4>
                                </div>
                                <ul class="link">
                                    <li><a href="{{ route('transaction') }}">{{ __('Check Out') }}</a></li>
                                    <li><a href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-4/5 sm:w-1/3 md:w-2/5 lg:w-2/6">
                    <div class="mt-12 footer-contact wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                        <div class="footer-title">
                            <h4 class="mb-8 text-2xl font-bold text-white">{{ __('Contact Us') }}</h4>
                        </div>
                        <ul class="contact">
                            <li>+62 831 6437 4335</li>
                            <li>+62 813 7005 2382</li>
                            <li>Jalan Simangambat No. 204A<br>Sipirok, Tapanuli Selatan, Sumatera Utara</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-8 border-t border-gray-200 footer-copyright">
            <p class="text-white">
                Template by <a class="duration-300 hover:text-theme-color-2" href="https://tailwindtemplates.co"
                    rel="nofollow" target="_blank">TailwindTemplates</a> and
                <a class="duration-300 hover:text-theme-color-2" href="https://uideck.com" rel="nofollow"
                    target="_blank">UIdeck</a>
            </p>
        </div>
    </div>
    <div id="particles-2" class="particles"></div>
</footer>
