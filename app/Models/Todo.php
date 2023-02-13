<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function isSelectedTag(int $tag_id): string
    {
        return $this->tag_id === $tag_id ? 'selected' : '';
    }

    public function doSearch(?string $tag_id, ?string $keyword): Collection
    {
        return self::query()
            ->when(!is_null($tag_id), function (Builder $builder) use ($tag_id) {
                $builder->where('tag_id', $tag_id);
            })
            ->when(!is_null($keyword), function (Builder $builder) use ($keyword) {
                $builder->orWhere('content', 'LIKE', "%$keyword%");
            })
            ->get();
    }
}
