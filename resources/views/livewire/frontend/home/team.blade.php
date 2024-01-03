<section id="team" class="team-area pt-120">
    <div class="container">
        <div class="justify-center row">
            <div class="w-full lg:w-2/3">
                <div class="pb-8 text-center section-title">
                    <div class="m-auto line"></div>
                    <h3 class="title"><span>{{ __('Meet Our') }}</span> {{ __('Super Team Members') }}</h3>
                </div>
            </div>
        </div>
        <div class="justify-center row">
            @foreach ($teams as $team)
                <div class="w-full sm:w-2/3 lg:w-1/3">
                    <div class="mt-8 text-center single-team wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="relative team-image">
                            <img class="w-64 mx-auto aspect-square"
                                src="{{ asset('frontend-assets/images/team-' . $team->gender . '.png') }}"
                                alt="Team">
                            <div class="team-social">
                                <ul>
                                    <li><a href="{{ $team->platform->facebook }}"><i
                                                class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="{{ $team->platform->twitter }}"><i
                                                class="lni lni-twitter-filled"></i></a></li>
                                    <li><a href="{{ $team->platform->instagram }}"><i
                                                class="lni lni-instagram-filled"></i></a></li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-8">
                            <h5 class="mb-1 text-xl font-bold text-gray-900">
                                {{ $team->name }}
                            </h5>
                            <p>{{ $team->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
