<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index', [
            'tags' => Auth::user()->tags,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag($request->all());
        $tag->user()
            ->associate(Auth::user())
            ->save();

        return redirect()->route('tags.index');
    }

    /**
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * @param StoreTag $request
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTag $request, Tag $tag)
    {
        $tag->update($request->all());

        return redirect()->route('tags.index');
    }

    /**
     * @param \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if (!$tag->transactions->isEmpty()) {
            return redirect()
                ->route('tags.index')
                ->with('error', 'Cannot delete tags with transactions');
        }

        $tag->delete();

        return redirect()->route('tags.index');
    }
}
