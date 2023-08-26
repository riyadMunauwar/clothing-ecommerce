<div class="bg-white p-5">
    <h6 class="text-lg font-bold dark:text-white">Latest Search Terms</h6>
    <div class="overflow-x-auto z-20 mt-3">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Keyword</th>
                    <th scope="col" class="px-4 py-3">Results</th>
                    <th scope="col" class="px-4 py-3">Hits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keywords ?? [] as $keyword)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $keyword->keyword ?? '' }}
                        </th>
                        <td class="px-4 py-1">{{ $keyword->results ?? '' }}</td>
                        <td class="px-4 py-1">{{ $keyword->hits ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>