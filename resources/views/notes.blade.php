@extends('layouts.master')

@section('title')
    Quick geek notes
@endsection

@section('content')
    @if (!empty(Request::segment(1))) {{--that is if first url segment is not empty--}}
        <div class="filter-bar">
            Go back to <a href="{{{ route('notes') }}}">show all notes</a>
        </div>
    @endif

    @if (count($errors) > 0)
        <div id="errorInfo">
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
        </div>
    @endif
    @if (Session::has('success'))
        <div id="successInfo">
            {{ Session::get('success') }}
        </div>
    @endif

    <section class="notes">
        <h3>Latest Notes</h3>
        @for ($i=0; $i < count($notes); $i++)
            <article class="note">    {{--using tenary {{ $i % 3 === 0 ? ' first-in-line' : (($i + 1) % 3 === 0 ? ' last-in-line' : '') }} --}}
                <div class="delete"><a href="{{ route('delete', ['note_id' => $notes[$i]->id]) }}">X</a></div>
                {{ $notes[$i]->note }} {{--note is the name of the column in the notes table--}}
                <div class="info">Created by <a href="{{ route('notes', ['author' => $notes[$i]->author->author_name]) }}">{{ $notes[$i]->author->author_name }}</a> {{ $notes[$i]->created_at }} </div> {{--the ->author is the function relationship declared in the note model while author_name is the name of the table in the authors table--}}
            </article>
        @endfor
        <div class="pagination">
            @if ($notes->currentPage() !== 1)
                <a href="{{ $notes->previousPageUrl() }}">Prev</a>
            @endif
            @if ($notes->currentPage() !== $notes->lastPage() && $notes->hasPages())
                <a href="{{ $notes->nextPageUrl() }}"> Next</a>
            @endif
        </div>
    </section>
    <section class="add-note">
        <h2>Add a note</h2>
        <form class="" action="{{ route('create') }}" method="post">
            <div class="form-input">
                <label for="author">Author Name</label>
                <input type="text" name="author_name" value="" placeholder="Enter your name" id="author_name">
            </div>
            <div class="form-input">
                <label for="note">Note</label>
                <textarea name="note" value="" placeholder="Type a short note" id="note" rows="5"></textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">    {{---This token input is very important in any form in laravel --}}
        </form>
    </section>
@endsection
