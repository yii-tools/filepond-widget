<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests;

use PHPUnit\Framework\TestCase;
use Yii\FilePond\Asset;
use Yii\FilePond\FilePond;
use Yii\FilePond\Tests\Support\TestForm;
use Yii\FilePond\Tests\Support\TestTrait;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testAllowMultiple(): void
    {
        FilePond::widget([new TestForm(), 'string'])->allowMultiple(true)->render();

        $this->assertStringContainsString('"allowMultiple":true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testCanBePluginImageCrop(): void
    {
        FilePond::widget([new TestForm(), 'string'])->canBePluginImageCrop()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageCrop', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testCanBePluginPdfPreview(): void
    {
        FilePond::widget([new TestForm(), 'string'])->canBePluginPdfPreview()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginPdfPreview', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testClassName(): void
    {
        FilePond::widget([new TestForm(), 'string'])->className('TestClass')->render();

        $this->assertStringContainsString('"className":"TestClass"', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testEnvironmentAssetWithCdn(): void
    {
        FilePond::widget([new TestForm(), 'string'])->environmentAsset('Cdn')->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewCdnAsset::class));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws JsonException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testEnvironmentAssetWithDev(): void
    {
        FilePond::widget([new TestForm(), 'string'])->environmentAsset('Dev')->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewDevAsset::class));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testLabelIdle(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->labelIdle('Drag & Drop or <span class="filepond--label-action"> Browse </span>')
            ->render();

        $this->assertStringContainsString(
            '"labelIdle":"Drag & Drop or <span class=\"filepond--label-action\"> Browse <\/span>"',
            $this->getScript(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testLocale(): void
    {
        FilePond::widget([new TestForm(), 'string'])->locale('es')->render();

        $this->assertStringContainsString(
            '"labelIdle":"Arrastra y suelta tus archivos o <span class = \"filepond--label-action\"> Examinar <span>"',
            $this->getScript(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testMaxFiles(): void
    {
        FilePond::widget([new TestForm(), 'string'])->maxFiles(3)->render();

        $this->assertStringContainsString('"maxFiles":3', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testName(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="test-name[]" type="file">',
            FilePond::widget([new TestForm(), 'string'])->name('test-name')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testOptions(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->options([
                'forceRevert' => true,
                'storeAsFile' => true,
            ])
            ->render();

        $this->assertStringContainsString('"forceRevert":true,"storeAsFile":true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testPluingDefault(): void
    {
        FilePond::widget([new TestForm(), 'string'])->canBePluginPdfPreview()->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="TestForm[string][]" type="file">',
            FilePond::widget([new TestForm(), 'string'])->canBePluginImageCrop()->canBePluginPdfPreview()->render(),
        );
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewProdAsset::class));
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testRequired(): void
    {
        FilePond::widget([new TestForm(), 'string'])->required()->render();

        $this->assertStringContainsString('"required":true', $this->getScript());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     * @throws \Yiisoft\Assets\Exception\InvalidConfigException
     */
    public function testTranslation(): void
    {
        FilePond::widget([new TestForm(), 'string'])->render();

        $script = $this->getScript();

        $this->assertStringContainsString('labelIdle', $script);
        $this->assertStringContainsString('labelInvalidField', $script);
        $this->assertStringContainsString('labelFileWaitingForSize', $script);
        $this->assertStringContainsString('labelFileSizeNotAvailable', $script);
        $this->assertStringContainsString('labelFileLoading', $script);
        $this->assertStringContainsString('labelFileLoadError', $script);
        $this->assertStringContainsString('labelFileProcessing', $script);
        $this->assertStringContainsString('labelFileProcessingComplete', $script);
        $this->assertStringContainsString('labelFileProcessingAborted', $script);
        $this->assertStringContainsString('labelFileProcessingError', $script);
        $this->assertStringContainsString('labelFileProcessingRevertError', $script);
        $this->assertStringContainsString('labelFileRemoveError', $script);
        $this->assertStringContainsString('labelTapToCancel', $script);
        $this->assertStringContainsString('labelTapToRetry', $script);
        $this->assertStringContainsString('labelTapToUndo', $script);
        $this->assertStringContainsString('labelButtonRemoveItem', $script);
        $this->assertStringContainsString('labelButtonAbortItemLoad', $script);
        $this->assertStringContainsString('labelButtonRetryItemLoad', $script);
        $this->assertStringContainsString('labelButtonAbortItemProcessing', $script);
        $this->assertStringContainsString('labelButtonUndoItemProcessing', $script);
        $this->assertStringContainsString('labelButtonRetryItemProcessing', $script);
        $this->assertStringContainsString('labelButtonProcessItem', $script);
        $this->assertStringContainsString('labelMaxFileSizeExceeded', $script);
        $this->assertStringContainsString('labelMaxFileSize', $script);
        $this->assertStringContainsString('labelMaxTotalFileSizeExceeded', $script);
        $this->assertStringContainsString('labelMaxTotalFileSize', $script);
        $this->assertStringContainsString('labelFileTypeNotAllowed', $script);
        $this->assertStringContainsString('fileValidateTypeLabelExpectedTypes', $script);
        $this->assertStringContainsString('imageValidateSizeLabelFormatError', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageSizeTooSmall', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageSizeTooBig', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMinSize', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMaxSize', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageResolutionTooLow', $script);
        $this->assertStringContainsString('imageValidateSizeLabelImageResolutionTooHigh', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMinResolution', $script);
        $this->assertStringContainsString('imageValidateSizeLabelExpectedMaxResolution', $script);
    }

    /**
     * @psalm-suppress MixedMethodCall
     */
    private function getScript(): string
    {
        $script = '';

        /** @psalm-var string[][] $getAllJs */
        $getAllJs = Assert::inaccessibleProperty($this->webView, 'state')->getJS();

        foreach ($getAllJs as $js) {
            foreach ($js as $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
