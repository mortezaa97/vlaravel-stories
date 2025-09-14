<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mortezaa97\Stories\Http\Resources\StoryResource;
use Mortezaa97\Stories\Models\Story;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $items = new Story;

        if ($request->page_slug) {
            $page = Page::where('slug', $request->page_slug)->first();

            return $request->noPaginate
            ? StoryResource::collection($page->stories)
            : StoryResource::collection($page->stories->paginate());
        }

        if ($request->conditions) {
            $items = $items->where(json_decode($request->conditions, true));
        }

        if ($request->with) {
            $items = $items->with($request->with);
        }

        return $request->noPaginate
        ? StoryResource::collection($items->get())
        : StoryResource::collection($items->paginate());
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Story::class);
        try {
            DB::beginTransaction();
            $item = new Story;
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $story = $item->create($data);

            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return $story;
    }

    public function show(Story $story)
    {
        return $story;
    }

    public function update(Request $request, Story $story)
    {
        Gate::authorize('update', $story);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['updated_by'] = Auth::user()->id;
            $story->update($data);

            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return $story;
    }

    public function destroy(Story $story)
    {
        Gate::authorize('delete', $story);
        try {
            DB::beginTransaction();
            $story->delete();
            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return response()->json('با موفقیت حذف شد');
    }
}
