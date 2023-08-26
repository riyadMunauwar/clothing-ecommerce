<x-admin.master-layout title="Dashboard">

    <div>
        <livewire:admin.dashboard-report-box />
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-5 md:mt-5">
        <div  class="col-span-1 bg-white rounded-sm">
            <livewire:admin.dashboard-latest-order-list-box />
        </div>
        <div  class="col-span-2 bg-white rounded-sm">
            <livewire:admin.current-month-sales-chart />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-5 md:mt-5">
        <div class="col-span-2 bg-white rounded-sm">
            <livewire:admin.current-month-orders-chart />
        </div>
        <div class="col-span-1 bg-white rounded-sm">
            <livewire:admin.latest-search-keyword-list />
        </div>
    </div>

</x-admin.master-layout>

