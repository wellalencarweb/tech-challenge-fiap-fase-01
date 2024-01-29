<?php

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use  HasFactory;

    protected $table = 'orders';

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

    protected static function newFactoryTimes(int $count): OrderFactory
    {
        return OrderFactory::times($count);
    }
}
