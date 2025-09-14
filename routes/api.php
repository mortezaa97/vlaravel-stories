<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use Mortezaa97\Stories\Http\Controllers\StoryController;

Route::get('stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('stories/{story:slug}', [StoryController::class, 'show'])->name('stories.show');
