<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sidebar = [
            [
                'title' => '',
                'menus' => [
                    [
                        'title' => 'Dashboard',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M14.06 9.94L12 9l2.06-.94L15 6l.94 2.06L18 9l-2.06.94L15 12zM4 14l.94-2.06L7 11l-2.06-.94L4 8l-.94 2.06L1 11l2.06.94zm4.5-5l1.09-2.41L12 5.5L9.59 4.41L8.5 2L7.41 4.41L5 5.5l2.41 1.09zm-4 11.5l6-6.01l4 4L23 8.93l-1.41-1.41l-7.09 7.97l-4-4L3 19z"/></svg>',
                        'uri' => route('dashboard.home'),
                        'is_active' => request()->routeIs('dashboard.home')
                    ]
                ],
            ],
            [
                'title' => '',
                'menus' => [
                    [
                        'title' => 'Direct Purchase',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M2 12q0 1.7.85 3.113t2.275 2.162q.35.2.513.575t.012.75q-.15.4-.525.575T4.4 19.15q-1.95-1-3.175-2.887T0 12q0-2.35 1.188-4.225T4.3 4.9q.35-.2.738-.038t.562.563q.175.35.025.725t-.5.575Q3.7 7.475 2.85 8.888T2 12Zm12 8q-3.325 0-5.663-2.337T6 12q0-3.325 2.337-5.663T14 4q1.4 0 2.65.45t2.275 1.25q.325.25.325.65t-.3.7q-.275.275-.688.3t-.762-.225q-.75-.55-1.638-.837T14 6q-2.5 0-4.25 1.75T8 12q0 2.5 1.75 4.25T14 18q.975 0 1.863-.288t1.637-.837q.35-.25.763-.225t.687.3q.3.3.3.7t-.325.65q-1.025.8-2.275 1.25T14 20Zm6.2-7H14q-.425 0-.713-.288T13 12q0-.425.288-.713T14 11h6.2l-.9-.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l2.6 2.6q.3.3.3.7t-.3.7l-2.6 2.6q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7l.9-.9Z"/></svg>',
                        'uri' => route('dashboard.direct-purchase'),
                        'is_active' => request()->routeIs('dashboard.direct-purchase')
                    ]
                ],
            ],
            [
                'title' => 'Master Data',
                'menus' => [
                    [
                        'title' => 'Category',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 32 32"><path fill="currentColor" d="m6.76 6l.45.89L7.76 8H12v5H4V6zm.62-2H3a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9l-.72-1.45a1 1 0 0 0-.9-.55m15.38 2l.45.89l.55 1.11H28v5h-8V6zm.62-2H19a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-4l-.72-1.45a1 1 0 0 0-.9-.55M6.76 19l.45.89l.55 1.11H12v5H4v-7zm.62-2H3a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1H9l-.72-1.45a1 1 0 0 0-.9-.55m15.38 2l.45.89l.55 1.11H28v5h-8v-7zm.62-2H19a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-4l-.72-1.45a1 1 0 0 0-.9-.55"/></svg>',
                        'uri' => route('dashboard.category'),
                        'is_active' => request()->routeIs('dashboard.category')
                    ],
                    [
                        'title' => 'Product',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m0 6h-4c0 1.62-1.38 3-3 3s-3-1.38-3-3H5V5h14zm-4 7h6v3c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2v-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3"/></svg>',
                        'uri' => route('dashboard.product'),
                        'is_active' => request()->routeIs('dashboard.product')
                    ],
                    [
                        'title' => 'Payment Vendor',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M4 17V5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v12a1 1 0 0 1 .351 1.936l-8 3a1 1 0 0 1-.702 0l-8-3A1 1 0 0 1 4 17m9-11a1 1 0 1 0-2 0v1h-1a2.5 2.5 0 0 0 0 5h4a.5.5 0 0 1 0 1H9a1 1 0 1 0 0 2h2v1a1 1 0 1 0 2 0v-1h1a2.5 2.5 0 0 0 0-5h-4a.5.5 0 0 1 0-1h5a1 1 0 1 0 0-2h-2z"/></g></svg>',
                        'uri' => route('dashboard.payment-vendor'),
                        'is_active' => request()->routeIs('dashboard.payment-vendor')
                    ]
                ]
            ],
            [
                'title' => "Transaction",
                'menus' => [
                    [
                        'title' => 'Waiting For Confirmation',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M9 20c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2m8-2c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m-9.8-3.2v-.1l.9-1.7h7.4c.7 0 1.4-.4 1.7-1l3.9-7l-1.7-1l-3.9 7h-7L4.3 2H1v2h2l3.6 7.6L5.2 14c-.1.3-.2.6-.2 1c0 1.1.9 2 2 2h12v-2H7.4c-.1 0-.2-.1-.2-.2M18 2.8l-1.4-1.4l-4.8 4.8l-2.6-2.6L7.8 5l4 4z"/></svg>',
                        'uri' => route('dashboard.transaction.type', ['type' => Str::of('WaitingForConfirmation')->kebab()->value]),
                        'is_active' => request()->fullUrlIs(route('dashboard.transaction.type', ['type' => Str::of('WaitingForConfirmation')->kebab()->value])),
                    ],
                    [
                        'title' => 'Waiting For Delivery',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M12 0L8 4h2v4h4V4h2M1 2v2h2l3.6 7.6L5.2 14c-.1.3-.2.6-.2 1c0 1.1.9 2 2 2h12v-2H7.4c-.1 0-.2-.1-.2-.2v-.1l.9-1.7h7.4c.7 0 1.4-.4 1.7-1l3.9-7l-1.7-1l-3.9 7h-7L4.3 2M7 18c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m10 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2"/></svg>',
                        'uri' => route('dashboard.transaction.type', ['type' => Str::of('WaitingForDelivery')->kebab()->value]),
                        'is_active' => request()->fullUrlIs(route('dashboard.transaction.type', ['type' => Str::of('WaitingForDelivery')->kebab()->value])),
                    ],
                    [
                        'title' => 'Canceled',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M14.1 8.5L12 6.4L9.9 8.5L8.5 7.1L10.6 5L8.5 2.9l1.4-1.4L12 3.6l2.1-2.1l1.4 1.4L13.4 5l2.1 2.1zM7 18c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10 0c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m-9.8-3.2c0 .1.1.2.2.2H19v2H7c-1.1 0-2-.9-2-2c0-.4.1-.7.2-1l1.3-2.4L3 4H1V2h3.3l4.3 9h7l3.9-7l1.7 1l-3.9 7c-.3.6-1 1-1.7 1H8.1l-.9 1.6z"/></svg>',
                        'uri' => route('dashboard.transaction.type', ['type' => Str::of('Canceled')->kebab()->value]),
                        'is_active' => request()->fullUrlIs(route('dashboard.transaction.type', ['type' => Str::of('Canceled')->kebab()->value]))
                    ],
                    [
                        'title' => 'Completed',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M9 20c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2m8-2c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m-9.8-3.2v-.1l.9-1.7h7.4c.7 0 1.4-.4 1.7-1l3.9-7l-1.7-1l-3.9 7h-7L4.3 2H1v2h2l3.6 7.6L5.2 14c-.1.3-.2.6-.2 1c0 1.1.9 2 2 2h12v-2H7.4c-.1 0-.2-.1-.2-.2M12 9.3l-.6-.5C9.4 6.9 8 5.7 8 4.2C8 3 9 2 10.2 2c.7 0 1.4.3 1.8.8c.4-.5 1.1-.8 1.8-.8C15 2 16 2.9 16 4.2c0 1.5-1.4 2.7-3.4 4.6z"/></svg>',
                        'uri' => route('dashboard.transaction.type', ['type' => Str::of('Completed')->kebab()->value]),
                        'is_active' => request()->fullUrlIs(route('dashboard.transaction.type', ['type' => Str::of('Completed')->kebab()->value]))
                    ],
                    [
                        'title' => 'See All',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M19 20c0 1.11-.89 2-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2a2 2 0 0 1 2 2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2c1.11 0 2-.89 2-2s-.89-2-2-2m.2-3.37l-.03.12c0 .14.11.25.25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2h3.27l.94 2H20c.55 0 1 .45 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1zM8.5 11H10V9H7.56zM11 9v2h3V9zm3-1V6h-3v2zm3.11 1H15v2h1zm1.67-3H15v2h2.67zM6.14 6l.94 2H10V6z"/></svg>',
                        'uri' => route('dashboard.transaction'),
                        'is_active' => request()->routeIs('dashboard.transaction')
                    ]
                ]
            ],
            [
                'title' => 'Report',
                'menus' => [
                    [
                        'title' => 'Sales Report',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20"><path fill="currentColor" d="M4 5a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v7h3v2a3 3 0 0 1-3 3h-4.05c.033-.162.05-.329.05-.5V16h3V5a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v6H4zm13 8h-2v3a2 2 0 0 0 2-2zM7 6.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m3 4A1.5 1.5 0 0 0 8.5 12h-6A1.5 1.5 0 0 0 1 13.5v3A1.5 1.5 0 0 0 2.5 18h6a1.5 1.5 0 0 0 1.5-1.5zm-1 2v1a.5.5 0 0 0-.5.5h-1A1.5 1.5 0 0 1 9 15.5M8.5 13a.5.5 0 0 0 .5.5v1A1.5 1.5 0 0 1 7.5 13zm-6.5.5a.5.5 0 0 0 .5-.5h1A1.5 1.5 0 0 1 2 14.5zm.5 3.5a.5.5 0 0 0-.5-.5v-1A1.5 1.5 0 0 1 3.5 17zM4 15a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0"/></svg>',
                        'uri' => route('dashboard.report.sales'),
                        'is_active' => request()->routeIs('dashboard.report.sales')
                    ],
                    [
                        'title' => 'Income Report',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12a3 3 0 1 0 3 3a3 3 0 0 0-3-3m0 4a1 1 0 1 1 1-1a1 1 0 0 1-1 1m-.71-6.29a1 1 0 0 0 .33.21a.94.94 0 0 0 .76 0a1 1 0 0 0 .33-.21L15 7.46A1 1 0 1 0 13.54 6l-.54.59V3a1 1 0 0 0-2 0v3.59L10.46 6A1 1 0 0 0 9 7.46ZM19 15a1 1 0 1 0-1 1a1 1 0 0 0 1-1m1-7h-3a1 1 0 0 0 0 2h3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3a1 1 0 0 0 0-2H4a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3v-8a3 3 0 0 0-3-3M5 15a1 1 0 1 0 1-1a1 1 0 0 0-1 1"/></svg>',
                        'uri' => route('dashboard.report.income'),
                        'is_active' => request()->routeIs('dashboard.report.income')
                    ]
                ]
            ],
            [
                'title' => 'Configuration',
                'menus' => [
                    [
                        'title' => 'User Management',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 256 256"><path fill="currentColor" d="M244.8 150.4a8 8 0 0 1-11.2-1.6A51.6 51.6 0 0 0 192 128a8 8 0 0 1-7.37-4.89a8 8 0 0 1 0-6.22A8 8 0 0 1 192 112a24 24 0 1 0-23.24-30a8 8 0 1 1-15.5-4A40 40 0 1 1 219 117.51a67.94 67.94 0 0 1 27.43 21.68a8 8 0 0 1-1.63 11.21M190.92 212a8 8 0 1 1-13.84 8a57 57 0 0 0-98.16 0a8 8 0 1 1-13.84-8a72.06 72.06 0 0 1 33.74-29.92a48 48 0 1 1 58.36 0A72.06 72.06 0 0 1 190.92 212M128 176a32 32 0 1 0-32-32a32 32 0 0 0 32 32m-56-56a8 8 0 0 0-8-8a24 24 0 1 1 23.24-30a8 8 0 1 0 15.5-4A40 40 0 1 0 37 117.51a67.94 67.94 0 0 0-27.4 21.68a8 8 0 1 0 12.8 9.61A51.6 51.6 0 0 1 64 128a8 8 0 0 0 8-8"/></svg>',
                        'uri' => route('dashboard.configuration.user'),
                        'is_active' => request()->routeIs('dashboard.configuration.user')
                    ],
                    [
                        'title' => 'Account Settings',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="m9.25 22l-.4-3.2q-.325-.125-.613-.3t-.562-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2h-5.5ZM11 20h1.975l.35-2.65q.775-.2 1.438-.588t1.212-.937l2.475 1.025l.975-1.7l-2.15-1.625q.125-.35.175-.737T17.5 12q0-.4-.05-.787t-.175-.738l2.15-1.625l-.975-1.7l-2.475 1.05q-.55-.575-1.212-.962t-1.438-.588L13 4h-1.975l-.35 2.65q-.775.2-1.437.588t-1.213.937L5.55 7.15l-.975 1.7l2.15 1.6q-.125.375-.175.75t-.05.8q0 .4.05.775t.175.75l-2.15 1.625l.975 1.7l2.475-1.05q.55.575 1.213.963t1.437.587L11 20Zm1.05-4.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.012 2.475T12.05 15.5ZM12 12Z"/></svg>',
                        'uri' => route('dashboard.configuration.account'),
                        'is_active' => request()->routeIs('dashboard.configuration.account')
                    ]
                ]
            ]
        ];

        // ddd($sidebar);
        return view('components.backend.sidebar', compact('sidebar'));
    }
}
