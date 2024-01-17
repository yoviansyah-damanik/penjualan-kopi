<div>
    <div class="px-4 mb-3">
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <div class="relative flex-none w-full mt-1 mb-3 lg:w-48 sm:w-64 xl:w-96">
                <input type="text" wire:change="resetPage" wire:model.live='search'
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-950 focus:border-orange-950 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-950 dark:focus:border-orange-950"
                    placeholder="{{ __('Search for :search by :1 or :2', ['search' => __('users'), '1' => 'id', '2' => __(':name name', ['name' => __('user')])]) }}">
                <button wire:click='clear_search'
                    class="absolute text-gray-300 duration-75 -translate-y-1/2 hover:text-gray-700 top-1/2 right-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m7.825 12l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T5.425 12q0-.2.063-.375T5.7 11.3l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L7.825 12Zm6.6 0l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T12.026 12q0-.2.063-.375t.212-.325l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L14.425 12Z" />
                    </svg>
                </button>
            </div>
            <button id="createUserButton"
                class="flex items-center gap-1 text-white w-full lg:w-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button" data-drawer-target="drawer-create-user-default"
                data-drawer-show="drawer-create-user-default" aria-controls="drawer-create-user-default"
                data-drawer-placement="right">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M11 13H6q-.425 0-.713-.288T5 12q0-.425.288-.713T6 11h5V6q0-.425.288-.713T12 5q.425 0 .713.288T13 6v5h5q.425 0 .713.288T19 12q0 .425-.288.713T18 13h-5v5q0 .425-.288.713T12 19q-.425 0-.713-.288T11 18v-5Z" />
                </svg>
                {{ __('Add new :add', ['add' => __('user')]) }}
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Full Name') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Role') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __(':status Status', ['type' => __('Transaction')]) }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Status') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td>
                                    <div class="w-24 aspect-square">
                                        <img class="w-full" src="{{ $user->image_path }}"
                                            alt="{{ $user->name }} Image">
                                    </div>
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                        #{{ $user->id }}
                                    </div>
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $user->username }}
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <span @class([
                                        'border',
                                        'rounded-lg',
                                        'px-3',
                                        'py-1',
                                        'text-xs',
                                        'text-red-700' => $user->role_name == 'Administrator',
                                        'border-red-700' => $user->role_name == 'Administrator',
                                        'bg-red-100' => $user->role_name == 'Administrator',
                                        'text-blue-700' => $user->role_name != 'Administrator',
                                        'border-blue-700' => $user->role_name != 'Administrator',
                                        'bg-blue-100' => $user->role_name != 'Administrator',
                                    ])>
                                        {{ $user->role_name }}
                                    </span>
                                </td>
                                <td class="p-4 text-base text-gray-900 dark:text-white">
                                    <div class="space-y-1 text-sm text-gray-700">
                                        <div class="flex items-center gap-3">
                                            <span class="w-4 bg-green-300 rounded-full aspect-square"></span>
                                            {{ $user->transactions()->status(\App\Enums\TransactionStatusType::Completed)->count() }}
                                            {{ __(':type Transaction', ['type' => __('Completed')]) }}
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="w-4 bg-red-300 rounded-full aspect-square"></span>
                                            {{ $user->transactions()->status(\App\Enums\TransactionStatusType::Canceled)->count() }}
                                            {{ __(':type Transaction', ['type' => __('Canceled')]) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <span @class([
                                        'border',
                                        'border-green-700' => $user->status,
                                        'text-green-700' => $user->status,
                                        'bg-green-100' => $user->status,
                                        'border-red-700' => !$user->status,
                                        'text-red-700' => !$user->status,
                                        'bg-red-100' => !$user->status,
                                        'rounded-lg',
                                        'px-3',
                                        'py-1',
                                        'text-xs',
                                    ])>
                                        {{ $user->status ? __('Active') : __('Blocked') }}
                                    </span>
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    @if (!$user->isAdministrator)
                                        <button type="button" id="setActivationUserButton"
                                            wire:click="$dispatch('set_activation_user_data',{user: '{{ $user->id }}'})"
                                            data-drawer-target="drawer-set-activation-user-default"
                                            data-drawer-show="drawer-set-activation-user-default"
                                            aria-controls="drawer-set-activation-user-default"
                                            data-drawer-placement="right"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M14.5 23q-.625 0-1.063-.438T13 21.5v-7q0-.625.438-1.063T14.5 13h7q.625 0 1.063.438T23 14.5v7q0 .625-.438 1.063T21.5 23h-7Zm0-1.5h7v-.8q-.625-.775-1.525-1.238T18 19q-1.075 0-1.975.463T14.5 20.7v.8ZM18 18q.625 0 1.063-.438T19.5 16.5q0-.625-.438-1.063T18 15q-.625 0-1.063.438T16.5 16.5q0 .625.438 1.063T18 18Zm-7 4h-.875q-.375 0-.65-.25t-.325-.625l-.3-2.325q-.325-.125-.613-.3t-.562-.375l-2.175.9q-.35.15-.7.038t-.55-.438L2.4 15.4q-.2-.325-.125-.7t.375-.6l1.875-1.425Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L2.65 9.9q-.3-.225-.375-.6t.125-.7l1.85-3.225q.2-.325.55-.438t.7.038l2.175.9q.275-.2.575-.375t.6-.3l.3-2.325q.05-.375.325-.625t.65-.25h3.75q.375 0 .65.25t.325.625l.3 2.325q.325.125.613.3t.562.375l2.175-.9q.35-.15.7-.038t.55.438l1.85 3.25q.2.325.125.688t-.375.587L19.925 11H15.4q-.35-1.075-1.25-1.788t-2.1-.712q-1.45 0-2.475 1.025T8.55 12q0 1.2.675 2.1T11 15.35V22Z" />
                                            </svg>
                                            {{ __('Set activation') }}
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="9" class="p-4 text-center">
                                    {{ __('No data found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users)
                <div class="px-4 mt-7">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Set Activation User Drawer --}}
    <div id="drawer-set-activation-user-default"
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-sm p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            {{ __('Set activation') }}</h5>
        <button type="button" data-drawer-dismiss="drawer-set-activation-user-default"
            aria-controls="drawer-set-activation-user-default"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close') }}</span>
        </button>
        <livewire:backend.configuration.user.set-activation />
    </div>

    {{-- Add User Drawer --}}
    <div id="drawer-create-user-default"
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-sm p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            {{ __('New :new', ['new' => __('User')]) }}
        </h5>
        <button type="button" data-drawer-dismiss="drawer-create-user-default"
            aria-controls="drawer-create-user-default"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close') }}</span>
        </button>
        <livewire:backend.configuration.user.create />
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('closeDrawer', (el) => {
            // var driwerId = document.getElementById(el.detail)
            // var drawer_2 = getInstance('Drawer', drawerId);

            // driwerId.hide();
        })
    </script>
@endpush
