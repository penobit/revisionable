<?php

namespace Penobit\Revisionable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Penobit\Revisionable\HasRevisions;

/**
 * Add a revisionable model for testing purposes
 * I've chosen User, purely because the migration will already exist.
 *
 * Class User
 */
class User extends Model {
    use HasRevisions;

    protected $guarded = [];
}
