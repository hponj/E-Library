@extends('layouts.main')

@section('konten')
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">{{ $book->name }}</h2>
        
                <p class="text-gray-600 text-sm mb-4">
                    By: 
                    <a class="text-blue-600 hover:underline" href="/hall/author/{{ $book->author->slug }}">
                        {{ $book->author->name }}
                    </a> 
                    in 
                    <a class="text-blue-600 hover:underline" href="/hall/category/{{ $book->category->slug }}">
                        {{ $book->category->name }}
                    </a>
                </p>
        
                @if ($book->cover)
                <img src="{{ Storage::url($book->image) }}" alt="">
                @else
                <img src="https://picsum.photos/1200/400" alt="Cover Buku" class="w-full h-96 object-cover">
                @endif
        
                <article class="prose max-w-none my-6">
                    <p>{!! $book->body !!}</p>
                </article>
        
                <a href="/hall" class="inline-block text-blue-500 hover:underline mt-4">← Back to blog</a>
            </div>
        </div>
@endsection