@extends('layouts.app')
@section('content')
    <form action="{{ route('books.index') }}" method="get">
        <input class="input mb-3" type="text" name="title" value="{{ request('title') }}" placeholder="Search books">
        <div class="mb-3">
            <button class="btn" type="submit">Search</button>
            <a class="btn" href="{{ route('books.index') }}" target="_blank">Reset</a>
        </div>
    </form>
    @forelse($books as $book)
        <li class="mb-4">
            <div class="book-item">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="w-full flex-grow sm:w-auto">
                        <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                        <span class="book-author">by {{ $book->author }}</span>
                    </div>
                    <div>
                        <div class="book-rating">
                            {{ number_format($book->reviews_avg_rating, 1) }}
                        </div>
                        <div class="book-review-count">
                            out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @empty
        <li class="mb-4">
            <div class="empty-book-item">
                <p class="empty-text">No books found</p>
                <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
            </div>
        </li>
    @endforelse
@endsection
