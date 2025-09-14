<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Models;

// use App\Models\Category;
// use App\Models\Page;
// use App\Models\Review;
// use App\Models\User;
// use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Mortezaa97\Reviews\Models\Review;

class Story extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['is_liked', 'likes_count'];

    protected $with = [];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($story): void {
            $story->updated_by = auth()->user()->id;
        });

        static::addGlobalScope('order', function (Builder $builder): void {
            $builder->orderByDesc('created_at');
        });
    }

    protected function isLiked(): Attribute
    {
        return Attribute::make(get: function () {
            $user = Auth::guard('api')->user();
            if ($user) {
                return $this->wishlist()->where('user_id', $user->id)->exists();
            } else {
                return $this->wishlist()->where('ip', request()->ip())->exists();
            }
        });
    }

    protected function likesCount(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->wishlist()->count();
        });
    }

    /*
     * Relations
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    //    public function categories(): BelongsToMany
    //    {
    //        return $this->belongsToMany(
    //            related: Category::class,
    //            table: 'model_has_categories',
    //            foreignPivotKey: 'model_id',
    //            relatedPivotKey: 'category_id'
    //        );
    //    }
    //
    //    public function wishlist(): HasMany
    //    {
    //        return $this->hasMany(Wishlist::class, 'story_id');
    //    }
    //
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'model');
    }
    //
    //    public function pages()
    //    {
    //        return $this->morphedByMany(
    //            related: Page::class,
    //            name: 'model',
    //            table: 'model_has_stories',
    //            foreignPivotKey: 'story_id',
    //            relatedPivotKey: 'model_id'
    //        );
    //    }
}
