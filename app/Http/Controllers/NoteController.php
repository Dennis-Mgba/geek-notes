<?php
/*
1. define a name space - so that laravel is able to autoload this controller,
because when laravel get's a request it needs to load all classes need in for the request
*/
namespace App\Http\Controllers;
use App\Author;
use App\Note;

use \Illuminate\Http\Request; // this is essential for http 'post' request - it is an object.

// 2. define controller class
class NoteController extends Controller
{
    public function getNotes($author = null)
    {
        if (!is_null($author)) {
            $authorExist = Author::where('author_name', $author)->first();
            if ($authorExist) {
                $notes = $authorExist->notes()->orderBy('created_at', 'desc')->paginate(6);
            }
        } else {
            $notes = Note::orderBy('created_at', 'desc')->paginate(6);
        }
        // $notes = Note::all();
        return view('notes', ['notes' => $notes]);
    }


    public function postNote(Request $request)
    {
        $this->validate($request, [
            'author_name' => 'required | max:60 | alpha',
            'note' => 'required | max:500'
        ]);
        $authorName = ucfirst(strtolower($request['author_name'])); // capture request form input
        $noteText = $request['note'];                                  // capture request form input

        /*
        Using the Author model query the authors table from the database and fetch the name where the author_name matches the author name in the request
        get the first name that macth and compare by running a conditiion
        */
        $author = Author::where('author_name', $authorName)->first();
        if(!$author) {
            $author = new Author();
            $author->author_name = $authorName;
            $author->save();
        }

        $note = new Note();
        $note->note = $noteText;
        $author->notes()->save($note);   // notes() here is the function relationship declared in the Author model

        return redirect()->route('notes')->with([
            'success' => 'Note has been created'
        ]);
    }


    public function deleteNote($note_id)
    {   // to delete an item, we have to first find it
        $note = Note::find($note_id); // or $note = Note::where('id', $note_id)->first();
        $author_deleted = false;
        if (count($note->author->notes) === 1) {
            $note->author->delete();
            $author_deleted = true;
        }

        $note->delete();
        $msg = $author_deleted ? 'All notes by author deleted' : 'Note has been deleted';

        return redirect()->route('notes')->with([
            'success' => $msg
        ]);
    }
}
