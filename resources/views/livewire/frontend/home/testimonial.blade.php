<section id="testimonial" class="testimonial-area pt-120">
    <div class="container">
        <div class="justify-center row">
            <div class="w-full lg:w-2/3">
                <div class="pb-10 text-center section-title">
                    <div class="m-auto line"></div>
                    <h3 class="title">{{ __('Users sharing') }}<span> {{ __('their experience') }}</span></h3>
                </div>
            </div>
        </div>
        <div class="row testimonial-active wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.8s">
            @foreach ($testimonials as $testimonial)
                @if ($loop->first)
                    <div class="w-full lg:w-1/3">
                        <div class="single-testimonial">
                            <div class="flex items-center justify-between mb-6">
                                <div class="quota">
                                    <i class="text-4xl duration-300 lni lni-quotation text-theme-color"></i>
                                </div>
                                <div class="star">
                                    <ul class="flex">
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-8">
                                <p>
                                    {{ $testimonial->review }}
                                </p>
                            </div>
                            <div class="flex items-center testimonial-author">
                                <div class="relative author-image">
                                    <img class="shape"
                                        src="{{ asset('frontend-assets/images/textimonial-shape.svg') }}"
                                        alt="shape">
                                    <img class="author"
                                        src="{{ asset('frontend-assets/images/testi-' . $testimonial->gender . '.png') }}"
                                        alt="author">
                                </div>
                                <div class="author-content media-body">
                                    <h6 class="mb-1 text-xl font-bold text-gray-900">{{ $testimonial->name }}</h6>
                                    <p>{{ $testimonial->position }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-4">
                        <div class="single-testimonial">
                            <div class="flex items-center justify-between mb-6">
                                <div class="quota">
                                    <i class="text-4xl duration-300 lni lni-quotation text-theme-color"></i>
                                </div>
                                <div class="star">
                                    <ul class="flex">
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                        <li><i class="lni lni-star-filled text-theme-color-2"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-8">
                                <p>
                                    {{ $testimonial->review }}
                                </p>
                            </div>
                            <div class="flex items-center testimonial-author">
                                <div class="relative author-image">
                                    <img class="shape"
                                        src="{{ asset('frontend-assets/images/textimonial-shape.svg') }}"
                                        alt="shape">
                                    <img class="author"
                                        src="{{ asset('frontend-assets/images/testi-' . $testimonial->gender . '.png') }}"
                                        alt="author">
                                </div>
                                <div class="author-content media-body">
                                    <h6 class="mb-1 text-xl font-bold text-gray-900"> {{ $testimonial->name }}
                                    </h6>
                                    <p> {{ $testimonial->position }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
