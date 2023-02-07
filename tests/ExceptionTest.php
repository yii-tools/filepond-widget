<?php

declare(strict_types=1);

namespace Yii\Filepond\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\FilePond\FilePond;
use Yii\FilePond\Tests\Support\TestForm;
use Yii\FilePond\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testEnvironmentAsset(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid environment asset: test.');

        FilePond::widget([new TestForm(), 'string'])->environmentAsset('test');
    }
}
