<?php

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use  HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cpf'
    ];

    protected static function newFactoryTimes(int $count): ProductFactory
    {
        return ProductFactory::times($count);
    }
}
