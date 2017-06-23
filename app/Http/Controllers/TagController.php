<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Auth::user()->tags;

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $tag = new Tag($request->all());
        $tag->user()
            ->associate(Auth::user())
            ->save();

        return redirect()
            ->route('tags.index')
            ->withSuccess('New tag created successfully');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'tag' => $tag,
        ]);
    }

    public function update(StoreTag $request, Tag $tag)
    {
        $tag->update($request->all());

        return redirect()
            ->route('tags.index')
            ->withSuccess('Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->hasTransactions()) {
            return redirect()
                ->route('tags.index')
                ->withWarning('Cannot delete tag with associated transactions');
        }

        $tag->delete();

        return redirect()
            ->route('tags.index')
            ->withSuccess('Tag removed successfully');
    }
}
