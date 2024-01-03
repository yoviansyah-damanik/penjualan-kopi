<section id="products" class="services-area pt-120">
    <div class="container">
        <div class="justify-center row">
            <div class="w-full lg:w-2/3">
                <div class="pb-10 text-center section-title">
                    <div class="m-auto line"></div>
                    <h3 class="title">
                        {{ __('Selected coffee beans') }},
                        <span>
                            {{ __('Delicious coffee that you can enjoy every day!') }}
                        </span>
                    </h3>
                </div>
            </div>
        </div>
        <div class="justify-center row">
            @foreach ($products as $product)
                <div class="w-full sm:w-2/3 lg:w-1/3">
                    <div class="single-services wow fadeIn" data-wow-duration="1s"
                        data-wow-delay="{{ 0.2 + (($loop->iteration - 1) % 3) * 0.3 }}s">
                        <img class="w-64 mx-auto rounded-full aspect-square" src="{{ $product->main_image_path }}"
                            alt="{{ $product->name }} Image">
                        <div class="mt-8 services-content">
                            <h4
                                class="block mb-8 overflow-hidden text-xl font-bold text-gray-900 text-ellipsis whitespace-nowrap">
                                {{ $product->name }}
                            </h4>
                            <p class="mb-8">
                                {{ $product->excerpt }}
                            </p>
                            <a class="duration-300 hover:text-theme-color"
                                href="{{ route('product.show', $product->slug) }}">
                                {{ __('Show') }}
                                <i class="ml-2 lni lni-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-20 text-center">
            <a href="{{ route('product') }}" wire:navigate class="main-btn gradient-btn">{{ __('Show more') }}</a>
        </div>
    </div>
</section>
