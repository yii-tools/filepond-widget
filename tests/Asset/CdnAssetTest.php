<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests\Asset;

use PHPUnit\Framework\TestCase;
use Yii\FilePond\Tests\Support\TestTrait;

final class CdnAssetTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider \Yii\FilePond\Tests\Provider\CdnAssetProvider::assetBundles
     */
    public function testAssetRegister(string $type, string $cdnBundle, string $cdnDepend = null): void
    {
        $bundle = new $cdnBundle();

        if ($cdnDepend !== null) {
            $depend = new $cdnDepend();
        }

        $this->assetManager->registerMany([$cdnBundle]);

        if ($cdnDepend !== null && $type === 'Css') {
            $this->assertSame($depend->css[0], $this->assetManager->getCssFiles()[$depend->css[0]][0]);
        } elseif ($type === 'Css') {
            $this->assertSame($bundle->css[0], $this->assetManager->getCssFiles()[$bundle->css[0]][0]);
        }

        if ($cdnDepend !== null && $type === 'Js') {
            $this->assertEquals($depend->js[0], $this->assetManager->getJsFiles()[$depend->js[0]][0]);
        } elseif ($type === 'Js') {
            $this->assertEquals($bundle->js[0], $this->assetManager->getJsFiles()[$bundle->js[0]][0]);
        }
    }
}
