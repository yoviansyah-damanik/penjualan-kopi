<div>
    <div class="px-4 mb-3">
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <div class="relative flex-none w-full mt-1 mb-3 lg:w-48 sm:w-64 xl:w-96">
                <input type="text" wire:change="resetPage" wire:model.live='search'
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-950 focus:border-orange-950 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-950 dark:focus:border-orange-950"
                    placeholder="{{ __('Search for :search by :1 or :2', ['search' => __('categories'), '1' => 'id', '2' => __(':name name', ['name' => __('category')])]) }}">
                <button wire:click='clear_search'
                    class="absolute text-gray-300 duration-75 -translate-y-1/2 hover:text-gray-700 top-1/2 right-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m7.825 12l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T5.425 12q0-.2.063-.375T5.7 11.3l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L7.825 12Zm6.6 0l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T12.026 12q0-.2.063-.375t.212-.325l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L14.425 12Z" />
                    </svg>
                </button>
            </div>
            <button id="createCategoryButton"
                class="flex items-center gap-1 text-white w-full lg:w-auto bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M11 13H6q-.425 0-.713-.288T5 12q0-.425.288-.713T6 11h5V6q0-.425.288-.713T12 5q.425 0 .713.288T13 6v5h5q.425 0 .713.288T19 12q0 .425-.288.713T18 13h-5v5q0 .425-.288.713T12 19q-.425 0-.713-.288T11 18v-5Z" />
                </svg>
                {{ __('Add new :add', ['add' => __('category')]) }}
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
                                {{ __(':name Name', ['name' => __('Category')]) }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Description') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Related Products') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                        #{{ $category->id }}
                                    </div>
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->description }}
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ StringHelper::currency($category->products->count()) }}
                                    {{ $category->products->count() <= 1 ? __('product') : __('products') }}
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <button type="button" id="updateCategoryButton"
                                        wire:click="setItem('{{ $category->slug }}','update')"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ __('Update') }}
                                    </button>
                                    <button type="button" id="deleteCategoryButton"
                                        wire:click="setItem('{{ $category->slug }}','destroy')"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ __('Delete') }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="4" class="p-4 text-center">
                                    <span class="text-gray-700 dark:text-gray-300">
                                        {{ __('No data found.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($categories)
                <div class="px-4 mt-7">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Edit Category Drawer --}}
    <div id="drawer-update-category-default" wire:ignore.self
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-sm p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            {{ __('Update :update', ['update' => __('Category')]) }}
        </h5>
        <button type="button" wire:click="closeDrawer" wire:loading.attr='disabled'
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close') }}</span>
        </button>
        <livewire:backend.category.edit />
    </div>

    {{-- Delete Category Drawer --}}
    <div id="drawer-delete-category-default" wire:ignore.self
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-sm p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            {{ __('Delete :delete', ['delete' => __('Category')]) }}</h5>
        <button type="button" wire:click="closeDrawer" wire:loading.attr='disabled'
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close') }}</span>
        </button>

        <livewire:backend.category.delete />
    </div>

    {{-- Add Category Drawer --}}
    <div id="drawer-create-category-default" wire:ignore.self
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-sm p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            {{ __('New :new', ['new' => __('Category')]) }}
        </h5>
        <button type="button" wire:click="closeDrawer" wire:loading.attr='disabled'
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('Close') }}</span>
        </button>
        <livewire:backend.category.create />
    </div>
</div>

@push('scripts')
    <script type="module">
        // set the drawer menu element
        const $updateTargetEl = document.getElementById('drawer-update-category-default')
        const $createTargetEl = document.getElementById('drawer-create-category-default')
        const $destroyTargetEl = document.getElementById('drawer-delete-category-default')

        // options with default values
        const options = {
            placement: 'right',
            backdrop: true,
            bodyScrolling: false,
            edge: false,
            edgeOffset: '',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
            // onHide: () => {
            //     console.log('drawer is hidden');
            // },
            // onShow: () => {
            //     console.log('drawer is shown');
            // },
            // onToggle: () => {
            //     console.log('drawer has been toggled');
            // },
        }

        // instance options object
        const createInstanceOptions = {
            id: 'drawer-create-category-default',
            override: true
        }

        const updateInstanceOptions = {
            id: 'drawer-update-category-default',
            override: true
        }

        const destroyInstanceOptions = {
            id: 'drawer-destroy-category-default',
            override: true
        }

        const updateDrawer = new Drawer($updateTargetEl, options, updateInstanceOptions)
        const createDrawer = new Drawer($createTargetEl, options, createInstanceOptions)
        const destroyDrawer = new Drawer($destroyTargetEl, options, destroyInstanceOptions)

        const closeDrawer = () => {
            createDrawer.hide()
            updateDrawer.hide()
            destroyDrawer.hide()
        }

        document.addEventListener('openDrawer', (type) => {
            type = type.detail[0]
            if (type == 'update')
                updateDrawer.show()
            else if (type == 'destroy')
                destroyDrawer.show()
            else
                createDrawer.show()
        })

        document.addEventListener('closeDrawer', () => closeDrawer())

        document.getElementById('createCategoryButton').addEventListener('click', () => createDrawer.show())
    </script>
@endpush
