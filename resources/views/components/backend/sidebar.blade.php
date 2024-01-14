<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach ($sidebar as $index => $item)
                    <ul class="pb-2 space-y-2">
                        @if (!empty($item['title']))
                            <li>
                                <div class="px-3 pt-5 pb-2 font-bold text-gray-700 uppercase dark:text-gray-300">
                                    {{ __($item['title']) }}
                                </div>
                            </li>
                        @endif
                        @if (!empty($item['menus']))
                            @foreach ($item['menus'] as $menu)
                                @if (empty($menu['children']))
                                    <li>
                                        <a href="{{ $menu['uri'] }}" @class([
                                            'flex',
                                            'items-center',
                                            'p-2',
                                            'text-base',
                                            'text-orange-900',
                                            'rounded-lg',
                                            'group',
                                            'hover:bg-orange-100/30',
                                            'dark:text-orange-200',
                                            'dark:hover:bg-orange-700/30',
                                            '!bg-orange-100' => $menu['is_active'],
                                            'dark:!bg-orange-700' => $menu['is_active'],
                                            'cursor-not-allowed' => $menu['is_active'],
                                            'pointer-events-none' => $menu['is_active'],
                                            'mt-3' => $index > 0,
                                        ])>
                                            {!! $menu['icon'] !!}
                                            <span class="ml-3" sidebar-toggle-item>{{ __($menu['title']) }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                                            aria-controls="dropdown-{{ Str::of($menu['title'])->lower()->kebab() }}"
                                            data-collapse-toggle="dropdown-{{ Str::of($menu['title'])->lower()->kebab() }}"
                                            area-expanded='{{ collect($menu['children'])->some(fn($q) => request()->url() == $q['uri']) == 1 ? 'true' : 'false' }}'>
                                            {!! $menu['icon'] !!}
                                            <span class="flex-1 ml-3 text-left whitespace-nowrap"
                                                sidebar-toggle-item>{{ __($menu['title']) }}</span>
                                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <ul id="dropdown-{{ Str::of($menu['title'])->lower()->kebab() }}"
                                            @class([
                                                'hidden' => !collect($menu['children'])->some(
                                                    fn($q) => request()->url() == $q['uri']),
                                                'py-2',
                                                'space-y-2',
                                            ])>
                                            @foreach ($menu['children'] as $child)
                                                <li>
                                                    <a href="{{ $child['uri'] }}" @class([
                                                        'flex',
                                                        'items-center',
                                                        'p-2',
                                                        'text-base',
                                                        'text-orange-900',
                                                        'transition',
                                                        'duration-75',
                                                        'rounded-lg',
                                                        'pl-11',
                                                        'group',
                                                        'hover:bg-orange-100/30',
                                                        'dark:text-orange-200',
                                                        'dark:hover:bg-orange-700/30',
                                                        '!bg-orange-100' => $child['is_active'],
                                                        'dark:!bg-orange-700' => $child['is_active'],
                                                        'cursor-not-allowed' => $child['is_active'],
                                                        'pointer-events-none' => $child['is_active'],
                                                    ])>
                                                        {{ __($child['title']) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
