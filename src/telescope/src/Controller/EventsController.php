<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */

namespace FriendsOfHyperf\Telescope\Controller;

use FriendsOfHyperf\Telescope\EntryType;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;

#[Controller(server: 'telescope')]
class EventsController extends EntryController
{
    #[PostMapping(path: '/telescope/telescope-api/events')]
    public function list()
    {
        return $this->index();
    }

    #[GetMapping(path: '/telescope/telescope-api/events/{id}')]
    public function detail(string $id)
    {
        return $this->show($id);
    }

    /**
     * The entry type for the controller.
     *
     * @return string
     */
    protected function entryType()
    {
        return EntryType::EVENT;
    }

    /**
     * The watcher class for the controller.
     */
    protected function watcher()
    {
        // return RequestWatcher::class;
        return null;
    }
}
