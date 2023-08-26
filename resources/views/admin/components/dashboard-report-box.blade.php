<div class="grid grid-cols-1 md:grid-cols-4 md:gap-5">

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Total Sales</h6>
        <div class="flex justify-between items-center">
            <span class="text-violet-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($totalSales) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Total Orders</h6>
        <div class="flex justify-between items-center">
            <span class="text-violet-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($totalOrders) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Total Products</h6>
        <div class="flex justify-between items-center">
            <span class="text-violet-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($totalProducts) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Total Customers</h6>
        <div class="flex justify-between items-center">
            <span class="text-violet-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($totalCustomers) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Today Sales</h6>
        <div class="flex justify-between items-center">
            <span class="text-amber-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($todayTotalSales) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Today Orders</h6>
        <div class="flex justify-between items-center">
            <span class="text-amber-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($todayTotalOrders) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Today Products</h6>
        <div class="flex justify-between items-center">
            <span class="text-amber-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($todayTotalProducts) }}</h6>
        </div>
    </div>

    <div class="bg-white p-3 rounded-sm">
        <h6 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Today Customers</h6>
        <div class="flex justify-between items-center">
            <span class="text-amber-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </span>
            <h6 class="text-lg font-bold text-right">{{ number_format($todayTotalCustomers) }}</h6>
        </div>
    </div>

</div>