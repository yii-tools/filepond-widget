<?php

declare(strict_types=1);

namespace Yii\Filepond\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\FilePond\FilePond;
use Yii\FilePond\Tests\Support\TestForm;
use Yii\FilePond\Tests\Support\TestTrait;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    use TestTrait;

    public function testAssetManager(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The `assetManager()` property must be set.');

        FilePond::widget([new TestForm(), 'string'])
            ->attributes(['value' => 1])
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();
    }

    public function testTranslator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The `translator()` property must be set.');

        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->attributes(['value' => 1])
            ->webView($this->webView)
            ->render();
    }

    public function testWebView(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The `webView()` property must be set.');

        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->attributes(['value' => 1])
            ->translator($this->translator)
            ->render();
    }

    public function testEnvironmentAsset(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid environment asset: test.');

        FilePond::widget([new TestForm(), 'string'])->environmentAsset('test');
    }
}
