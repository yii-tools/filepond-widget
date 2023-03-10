<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests\Asset;

use PHPUnit\Framework\TestCase;
use Yii\FilePond\Tests\Support\TestTrait;

final class NpmAssetTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider \Yii\FilePond\Tests\Provider\NpmAssetProvider::assetBundles
     *
     * @throws InvalidConfigException
     *
     * @psalm-suppress InvalidStringClass
     */
    public function testAssetRegister(string $type, string $assetBundle, string $bundleDepend = null): void
    {
        $bundle = new $assetBundle();
        $depend = null;

        if ($bundleDepend !== null) {
            $depend = new $bundleDepend();
        }

        $this->assetManager->registerMany([$assetBundle]);

        if ($type === 'Css' && is_string($bundle->sourcePath) && isset($bundle->css[0])) {
            $getPublishedUrl = $this->assetPublisher->getPublishedUrl($bundle->sourcePath);
            /** @psalm-var string|null $css */
            $css = $bundle->css[0];

            if ($getPublishedUrl !== null && $css !== null) {
                $bundleUrl = $getPublishedUrl . '/' . $css;

                $this->assertFileExists(
                    dirname(__DIR__) . '/Support/runtime' . $this->assetManager->getCssFiles()[$bundleUrl][0],
                );
                $this->assertSame($bundleUrl, $this->assetManager->getCssFiles()[$bundleUrl][0]);
            }
        }

        if ($type === 'Css' && $depend !== null && is_string($depend->sourcePath) && isset($depend->css[0])) {
            $getPublishedUrl = $this->assetPublisher->getPublishedUrl($depend->sourcePath);
            /** @psalm-var string|null $css */
            $css = $depend->css[0];

            if ($getPublishedUrl !== null && $css !== null) {
                $dependUrl = $getPublishedUrl . '/' . $css;

                $this->assertFileExists(
                    dirname(__DIR__) . '/Support/runtime' . $this->assetManager->getCssFiles()[$dependUrl][0],
                );
                $this->assertSame($dependUrl, $this->assetManager->getCssFiles()[$dependUrl][0]);
            }
        }

        if ($type === 'Js' && $depend !== null && is_string($depend->sourcePath) && isset($depend->js[0])) {
            $getPublishedUrl = $this->assetPublisher->getPublishedUrl($depend->sourcePath);
            /** @psalm-var string|null $js */
            $js = $depend->js[0];
            if ($getPublishedUrl !== null && $js !== null) {
                $dependUrl = $getPublishedUrl . '/' . $js;
                $this->assertFileExists(
                    dirname(__DIR__) . '/Support/runtime' . $this->assetManager->getJsFiles()[$bundleUrl][0],
                );
                $this->assertSame($dependUrl, $this->assetManager->getJsFiles()[$dependUrl][0]);
            }
        }

        if ($type === 'Js' && is_string($bundle->sourcePath) && isset($bundle->js[0])) {
            $getPublishedUrl = $this->assetPublisher->getPublishedUrl($bundle->sourcePath);
            /** @psalm-var string|null $js */
            $js = $bundle->js[0];

            if ($getPublishedUrl !== null && $js !== null) {
                $bundleUrl = $getPublishedUrl . '/' . $js;
                $this->assertFileExists(
                    dirname(__DIR__) . '/Support/runtime' . $this->assetManager->getJsFiles()[$bundleUrl][0],
                );
                $this->assertSame($bundleUrl, $this->assetManager->getJsFiles()[$bundleUrl][0]);
            }
        }
    }
}
