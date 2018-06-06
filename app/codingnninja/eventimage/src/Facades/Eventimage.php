<?php

/*
 * This file is part of the Laravel Eventimage package.
 *
 * (c) Ogundiran Ayobami <ayobami_ogundiran@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Codingnninja\Eventimage\Facades;

use Illuminate\Support\Facades\Facade;

class Eventimage extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Eventimage';
    }
}
