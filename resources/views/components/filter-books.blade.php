<div class="filter-container mb-4 flex">
    @php
        $filters = [
            '' => 'Latest',
            'popular_last_month' => 'Popular last month',
            'popular_last_6_months' => 'Popular last 6 months',
            'highest_rated_last_month' => 'Highest rated last month',
            'highest_rated_last_6_months' => 'Highest rated last 6 months',
        ];
    @endphp
    @foreach ($filters as $key => $value)
        <a class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}"
            href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}">{{ $value }}</a>
    @endforeach
</div>

