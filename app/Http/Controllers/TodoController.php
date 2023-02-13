<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function __construct(private Todo $todo)
    {
    }

    public function content(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view(
            'index',
            [
                'user_name' => $user->name,
                'tags' => Tag::all(),
                'todos' => $user->todos()->with('tag')->get()
            ]
        );
    }

    public function create(TodoRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $attributes = array_merge(['user_id' => $user->id], $request->validated());

        Todo::query()->create($attributes);
        return redirect(route('dashboard'));
    }

    public function update(TodoRequest $request): RedirectResponse
    {
        $id = $request->input('id');
        Todo::query()->find($id)->fill($request->validated())->save();

        return redirect(route('dashboard'));
    }

    public function delete(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        Todo::destroy($id);
        return redirect(route('dashboard'));
    }

    public function find(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view(
            'search',
            [
                'user_name' => $user->name,
                'tags' => Tag::all(),
                'todos' => []
            ]
        );
    }

    public function search(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();

        $tag_id = $request->input('tag_id');
        $keyword = $request->input('keyword');

        return view(
            'search',
            [
                'user_name' => $user->name,
                'tags' => Tag::all(),
                'todos' => $this->todo->doSearch($user->id, $tag_id, $keyword)
            ]
        );
    }
}
