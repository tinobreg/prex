<?php

namespace App\Models;

use App\Helpers\GiphyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int    $id
 * @property int    $user_id
 * @property string    $gif_id
 * @property string    $alias
 *
 * @property User   $user
 * @property array   $gif
 */
class GifFavourites extends Model
{
    use HasFactory;

    /**
     * @var array|array[]
     */
    protected array $rules = [
        [['user_id'], 'exists:App\Models\User,id|integer'],
        [['gif_id'], 'required|string'],
        [['alias'], 'required|string'],
    ];

    /**
     * @var string
     */
    protected $table = 'gif_favourites';

    /**
     * @var string[]
     */
    public $fillable = [
        'user_id',
        'gif_id',
        'alias',
    ];

    public $timestamps = false;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function gif(): array
    {
        return GiphyHelper::view($this->gif_id);
    }
}
