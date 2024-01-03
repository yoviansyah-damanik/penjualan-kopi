<section id="facts" class="pt-20 video-counter">
    <div class="container">
        <div class="mx-4 mt-12 text-center counter-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
            <div class="counter-content">
                <div class="mb-8 section-title">
                    <div class="line"></div>
                    <h3 class="title">{{ __('Cool facts') }} <span> {{ __('about this app') }}</span></h3>
                </div>
                <p class="text">
                    {{ __('This application was built to make it easier to manage sales of coffee products at Kopi HTS Pardede.') }}
                </p>
            </div>
            <div class="justify-center row no-gutters">
                <div class="flex items-center justify-center single-counter counter-color-1">
                    <div class="text-center counter-items">
                        <span class="text-3xl font-bold text-white">
                            <span class="counter">
                                {{ StringHelper::currency($categories) }}
                            </span>
                        </span>
                        <p class="text-white">{{ __('Categories') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center single-counter counter-color-2">
                    <div class="text-center counter-items">
                        <span class="text-3xl font-bold text-white">
                            <span class="counter">
                                {{ StringHelper::currency($products) }}
                            </span>
                        </span>
                        <p class="text-white">{{ __('Products') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center single-counter counter-color-3">
                    <div class="text-center counter-items">
                        <span class="text-3xl font-bold text-white">
                            <span class="counter">
                                {{ StringHelper::currency($users) }}
                            </span>
                        </span>
                        <p class="text-white">{{ __('Active Users') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center single-counter counter-color-4">
                    <div class="text-center counter-items">
                        <span class="text-3xl font-bold text-white">
                            {{ StringHelper::currency($transactions) }}
                        </span>
                        <p class="text-white">{{ __('Successful Transactions') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
