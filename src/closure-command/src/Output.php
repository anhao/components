<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/3.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\ClosureCommand;

use Hyperf\Context\Context;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @mixin SymfonyStyle
 */
class Output
{
    public function __call($name, $arguments)
    {
        return Context::get(static::class)->{$name}(...$arguments);
    }
}
