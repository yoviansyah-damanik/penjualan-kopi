<div class="min-h-[60vh]">
    <div class="container py-12">
        <div class="flex flex-col gap-4 lg:flex-row">
            <div class="flex-none w-full lg:w-3/5">
                <livewire:frontend.transaction.items :key="rand()" :$carts lazy />
            </div>
            <div class="flex-none w-full lg:w-2/5">
                <livewire:frontend.transaction.form :key="rand()" :$carts />
            </div>
        </div>
    </div>
</div>
