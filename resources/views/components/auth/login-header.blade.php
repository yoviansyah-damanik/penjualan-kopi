<div navbar-menu
    class="items-end flex-grow transition-all ease duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-2xl lg:flex lg:basis-auto">
    <ul class="flex flex-col pl-0 mb-0 list-none lg-max:py-2 lg:flex-row xl:ml-auto">
        @foreach ($navs as $nav)
            <li>
                <a class="block px-4 py-2 text-sm font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-slate-700 lg:px-2"
                    aria-current="page" href="{{ $nav['path'] }}" @if ($nav['navigate'] == true) wire:navigate @endif>
                    <i class="mr-1 lg-max:text-slate-700 opacity-60 {{ $nav['icon'] }}"></i>
                    {{ $nav['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
