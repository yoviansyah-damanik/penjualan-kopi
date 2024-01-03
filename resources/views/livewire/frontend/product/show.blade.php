<div class="min-h-[60vh]">
    <div class="container py-12">
        <section class="splide" wire:ignore>
            <div class="splide__slider">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <img src="{{ $product->main_image_path }}" alt="{{ $product->name }} Image">
                        </li>
                        @if ($product->additional_image_paths->count() > 0)
                            @foreach ($product->additional_image_paths as $path)
                                <li class="splide__slide">
                                    <img src="{{ $path }}" alt="{{ $product->name }} Image">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </section>
        <div class="mt-5 lg:mt-7">
            <div class="flex flex-col items-center gap-5 lg:gap-3 lg:flex-row lg:flex-wrap">
                <div class="flex-auto order-1 lg:order-none">
                    <h4 class="text-xl font-bold lg:text-3xl">{{ $product->name }}</h4>
                    <div class="font-light">
                        {{ $product->category_name }} - {{ StringHelper::currency($product->weight) }} gram
                    </div>
                    <div class="mt-3">
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="flex-grow-0 flex-shrink-0 order-none w-full basis-full lg:basis-80 lg:order-1">
                    <div class="flex items-center justify-center">
                        <livewire:frontend.product.show-amount :$product />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        new Splide('.splide', {
            type: 'loop',
            autoplay: true,
            perPage: 3,
            perMove: 1,
            focus: 'center',
            trimSpace: false,
            pagination: false,
            gap: 0,
            padding: 0,
            autoWidth: false,
            breakpoints: {
                425: {
                    perPage: 1,
                }
            }
        }).mount();
    </script>
@endpush

@push('style')
    <style>
        .splide__slide {
            transform: scale(.8);
            transition: all .3s;
            opacity: .8;
        }

        .splide__slide.is-visible.is-active {
            transform: scale(1);
            opacity: 1;
        }
    </style>
@endpush
