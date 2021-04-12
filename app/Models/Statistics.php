<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Statistics"
 * )
 */
class Statistics extends Model
{
    use HasFactory;

    protected $table = 'statistics';
    protected $primaryKey = 'id';

    /**
     * @OA\Property(
     *     title="link",
     * )
     *
     * @var string
     */
    private $link;

    /**
     * @OA\Property(
     *     title="link_type",
     * )
     *
     * @var string
     */
    private $link_type;

    /**
     * @OA\Property(
     *     title="customer_uuid",
     * )
     *
     * @var string
     */
    private $customer_uuid;
}
