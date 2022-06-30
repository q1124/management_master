<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wishlist
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $price
 * @property int $status
 * @property string $c_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereCDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereUserId($value)
 * @mixin \Eloquent
 */
class Wishlist extends Model
{
    use HasFactory;
}
