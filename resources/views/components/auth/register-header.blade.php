<div navbar-menu
    class="items-end flex-grow transition-all ease duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-2xl lg:flex lg:basis-auto">
    <ul class="flex flex-col pl-0 mb-0 list-none lg-max:py-2 lg:flex-row xl:ml-auto">
        @foreach ($navs as $nav)
            <li>
                <a class="flex items-center px-4 py-2 mr-2 text-sm font-normal text-white transition-all ease-in-out duration-250 lg-max:opacity-0 lg-max:text-slate-700 lg:px-2 lg:hover:text-white/75"
                    aria-current="page" href="{{ $nav['path'] }}" @if ($nav['navigate'] == true) wire:navigate @endif>
                    <i class="mr-1 text-white lg-max:text-slate-700 opacity-60 {{ $nav['icon'] }}"></i>
                    {{ $nav['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
