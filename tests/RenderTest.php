<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests;

use PHPUnit\Framework\TestCase;
use Yii\FilePond\Asset;
use Yii\FilePond\FilePond;
use Yii\FilePond\Tests\Support\TestForm;
use Yii\FilePond\Tests\Support\TestTrait;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    public function testAllowMultiple(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="TestForm[string][]" type="file" multiple>',
            FilePond::widget([new TestForm(), 'string'])
                ->assetManager($this->assetManager)
                ->allowMultiple(true)
                ->translator($this->translator)
                ->webView($this->webView)
                ->render(),
        );
        $this->assertStringContainsString('"allowMultiple":true', $this->getScript());
    }

    public function testCanBePluginImageCrop(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginImageCrop()
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageCrop', $this->getScript());
    }

    public function testCanBePluginImageTransform(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginImageTransform()
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageTransform', $this->getScript());
    }

    public function testCanBePluginPdfPreview(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginPdfPreview()
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
        $this->assertStringContainsString('FilePondPluginPdfPreview', $this->getScript());
    }

    public function testClassName(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->className('TestClass')
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('"className":"TestClass"', $this->getScript());
    }

    public function testEnvironmentAssetWithCdn(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginImageCrop()
            ->canBePluginImageTransform()
            ->canBePluginPdfPreview()
            ->environmentAsset('Cdn')
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageCropCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageTransformCdnAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginPdfPreviewCdnAsset::class));
    }

    public function testEnvironmentAssetWithDev(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginImageCrop()
            ->canBePluginImageTransform()
            ->canBePluginPdfPreview()
            ->environmentAsset('Dev')
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageCropDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageTransformDevAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginPdfPreviewDevAsset::class));
    }

    public function testLabelIdle(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->labelIdle('Drag & Drop or <span class="filepond--label-action"> Browse </span>')
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString(
            '"labelIdle":"Drag & Drop or <span class=\"filepond--label-action\"> Browse <\/span>"',
            $this->getScript(),
        );
    }

    public function testLocale(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->locale('es')
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString(
            '"labelIdle":"Arrastra y suelta tus archivos o <span class = \"filepond--label-action\"> Examinar <span>"',
            $this->getScript(),
        );
    }

    public function testMaxFiles(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->maxFiles(3)
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('"maxFiles":3', $this->getScript());
    }

    public function testName(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="test-name[]" type="file">',
            FilePond::widget([new TestForm(), 'string'])
                ->assetManager($this->assetManager)
                ->name('test-name')
                ->translator($this->translator)
                ->webView($this->webView)
                ->render(),
        );
    }

    public function testOptions(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->options(['forceRevert' => true, 'storeAsFile' => true])
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('"forceRevert":true,"storeAsFile":true', $this->getScript());
    }

    public function testPluingDefault(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->canBePluginPdfPreview()
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('FilePondPluginFileEncode', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateSize', $this->getScript());
        $this->assertStringContainsString('FilePondPluginFileValidateType', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImageExifOrientation', $this->getScript());
        $this->assertStringContainsString('FilePondPluginImagePreview', $this->getScript());
    }

    public function testRender(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="TestForm[string][]" type="file">',
            FilePond::widget([new TestForm(), 'string'])
                ->assetManager($this->assetManager)
                ->canBePluginImageCrop()
                ->canBePluginImageTransform()
                ->canBePluginPdfPreview()
                ->translator($this->translator)
                ->webView($this->webView)
                ->render(),
        );
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\FilePondProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileEncodeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateSizeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginFileValidateTypeProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageExifOrientationProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImagePreviewProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageCropProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginImageTransformProdAsset::class));
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\PluginPdfPreviewProdAsset::class));
    }

    public function testRequired(): void
    {
        $this->assertSame(
            '<input class="filepond" id="testform-string" name="TestForm[string][]" type="file" required>',
            FilePond::widget([new TestForm(), 'string'])
                ->assetManager($this->assetManager)
                ->required()
                ->translator($this->translator)
                ->webView($this->webView)
                ->render(),
        );
        $this->assertStringContainsString('"required":true', $this->getScript());
    }

    public function testTranslation(): void
    {
        FilePond::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->translator($this->translator)
            ->webView($this->webView)
            ->render();

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

    private function getScript(): string
    {
        $script = '';

        /**
         * @psalm-var string[][] $getAllJs
         * @psalm-suppress MixedMethodCall
         */
        $getAllJs = Assert::inaccessibleProperty($this->webView, 'state')->getJS();

        foreach ($getAllJs as $js) {
            foreach ($js as $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
