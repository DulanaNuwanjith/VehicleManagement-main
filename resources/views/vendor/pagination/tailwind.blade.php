@if ($paginator->hasPages())
    <nav role="navigation" class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-1 text-sm">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 border rounded cursor-default">&lt;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1 text-gray-700 bg-white border rounded hover:bg-gray-200">&lt;</a>
                </li>
            @endif

            {{-- Page Links --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                if ($last <= 3) {
                    $start = 1;
                    $end = $last;
                } elseif ($current <= 2) {
                    $start = 1;
                    $end = 3;
                } elseif ($current >= $last - 1) {
                    $start = $last - 2;
                    $end = $last;
                } else {
                    $start = $current - 1;
                    $end = $current + 1;
                }
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li>
                        <span
                            class="px-3 py-1 text-white bg-amber-600 border border-amber-600 rounded">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($page) }}"
                            class="px-3 py-1 text-gray-700 bg-white border rounded hover:bg-gray-200">{{ $page }}</a>
                    </li>
                @endif
            @endfor

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-1 text-gray-700 bg-white border rounded hover:bg-gray-200">&gt;</a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 text-gray-400 bg-gray-100 border rounded cursor-default">&gt;</span>
                </li>
            @endif

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div class="p-2">
                    <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                        {!! __('Showing') !!}
                        @if ($paginator->firstItem())
                            <span class="font-medium">{{ $paginator->firstItem() }}</span>
                            {!! __('to') !!}
                            <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        @else
                            {{ $paginator->count() }}
                        @endif
                        {!! __('of') !!}
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        {!! __('results') !!}
                    </p>
                </div>

            </div>

        </ul>
    </nav>
@endif
