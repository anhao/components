<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */

namespace FriendsOfHyperf\AmqpJob;

use FriendsOfHyperf\AmqpJob\Contract\Attempt;
use FriendsOfHyperf\AmqpJob\Contract\JobInterface;
use Hyperf\Context\ApplicationContext;
use Throwable;

abstract class Job implements JobInterface
{
    protected bool $confirm = false;

    protected string $jobId = '';

    protected int $timeout = 5;

    protected int $maxAttempts = 0;

    public function getConfirm(): bool
    {
        return $this->confirm;
    }

    public function setJobId(string $jobId): self
    {
        $this->jobId = $jobId;
        return $this;
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function getMaxAttempts(): int
    {
        return $this->maxAttempts;
    }

    public function attempts(): bool
    {
        if ($this->getMaxAttempts() <= 0) {
            return false;
        }

        $attempts = $this->getAttempt()->increment($this->getJobId());

        return $this->getMaxAttempts() > $attempts;
    }

    /**
     * @return \Hyperf\Amqp\Result|string|void
     */
    abstract public function handle();

    public function fail(Throwable $e): void
    {
    }

    protected function getAttempt(): Attempt
    {
        return ApplicationContext::getContainer()->get(Attempt::class);
    }
}
