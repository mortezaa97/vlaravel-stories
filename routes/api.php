<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use Mortezaa97\Stories\Http\Controllers\StoryController;

Route::prefix('api/stories')->middleware('api')->group(function () {
    Route::get('/', [StoryController::class, 'index'])->name('stories.index');
    Route::get('/{story:slug}', [StoryController::class, 'show'])->name('stories.show');
});
