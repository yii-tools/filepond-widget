<?php

declare(strict_types=1);

namespace Yii\FilePond;

use InvalidArgumentException;
use Yii\FormModel\FormModelInterface;
use Yii\Html\Helper\CssClass;
use Yii\Html\Helper\Utils;
use Yii\Widget\AbstractWidget;
use Yii\Widget\Attribute;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

final class FilePond extends AbstractWidget
{
    use Attribute\HasName;
    use Concern\HasPluginFileValidateSize;
    use Concern\HasPluginFileValidateType;
    use Concern\HasPluginImageCrop;
    use Concern\HasPluginImageExifOrientation;
    use Concern\HasPluginImagePreview;
    use Concern\HasPluginImageTransform;
    use Concern\HasPluginPdfPreview;

    private AssetManager|null $assetManager = null;
    private string $environmentAsset = 'Prod';
    private string $locale = '';
    private array $options = [];
    /** @psalm-var string[] */
    private array $plugingAssets = [
        'FilePondPluginFileEncode' => 'Yii\FilePond\Asset\PluginFileEncode',
        'FilePondPluginFileValidateSize' => 'Yii\FilePond\Asset\PluginFileValidateSize',
        'FilePondPluginFileValidateType' => 'Yii\FilePond\Asset\PluginFileValidateType',
        'FilePondPluginImageCrop' => 'Yii\FilePond\Asset\PluginImageCrop',
        'FilePondPluginImageExifOrientation' => 'Yii\FilePond\Asset\PluginImageExifOrientation',
        'FilePondPluginImagePreview' => 'Yii\FilePond\Asset\PluginImagePreview',
        'FilePondPluginImageTransform' => 'Yii\FilePond\Asset\PluginImageTransform',
        'FilePondPluginPdfPreview' => 'Yii\FilePond\Asset\PluginPdfPreview',
    ];
    /** @psalm-var string[] */
    private array $pluginDefault = [
        'FilePondPluginFileEncode',
        'FilePondPluginFileValidateSize',
        'FilePondPluginFileValidateType',
        'FilePondPluginImageExifOrientation',
        'FilePondPluginImagePreview',
    ];
    private string $translationCategory = 'filepond';
    /** @psalm-var string[] */
    private array $translationTagDefault = [
        'labelIdle',
        'labelInvalidField',
        'labelFileWaitingForSize',
        'labelFileSizeNotAvailable',
        'labelFileLoading',
        'labelFileLoadError',
        'labelFileProcessing',
        'labelFileProcessingComplete',
        'labelFileProcessingAborted',
        'labelFileProcessingError',
        'labelFileProcessingRevertError',
        'labelFileRemoveError',
        'labelTapToCancel',
        'labelTapToRetry',
        'labelTapToUndo',
        'labelButtonRemoveItem',
        'labelButtonAbortItemLoad',
        'labelButtonRetryItemLoad',
        'labelButtonAbortItemProcessing',
        'labelButtonUndoItemProcessing',
        'labelButtonRetryItemProcessing',
        'labelButtonProcessItem',
        'labelMaxFileSizeExceeded',
        'labelMaxFileSize',
        'labelMaxTotalFileSizeExceeded',
        'labelMaxTotalFileSize',
        'labelFileTypeNotAllowed',
        'fileValidateTypeLabelExpectedTypes',
        'imageValidateSizeLabelFormatError',
        'imageValidateSizeLabelImageSizeTooSmall',
        'imageValidateSizeLabelImageSizeTooBig',
        'imageValidateSizeLabelExpectedMinSize',
        'imageValidateSizeLabelExpectedMaxSize',
        'imageValidateSizeLabelImageResolutionTooLow',
        'imageValidateSizeLabelImageResolutionTooHigh',
        'imageValidateSizeLabelExpectedMinResolution',
        'imageValidateSizeLabelExpectedMaxResolution',
    ];
    private TranslatorInterface|null $translator = null;
    private Webview|null $webView = null;

    public function __construct(private FormModelInterface $formModel, private string $attribute)
    {
    }

    /**
     * Return new instance with enable or disable multiple file upload.
     *
     * @param bool $value Enable or disable multiple file upload. Default: `true`.
     */
    public function allowMultiple(bool $value): self
    {
        $new = clone $this;
        $new->options['allowMultiple'] = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified asset manager instance.
     *
     * @param AssetManager $assetManager The asset manager instance.
     */
    public function assetManager(AssetManager $assetManager): self
    {
        $new = clone $this;
        $new->assetManager = $assetManager;

        return $new;
    }

    /**
     * Return new instance wheather enable or disable plugin image crop.
     */
    public function canBePluginImageCrop(): self
    {
        $new = clone $this;
        $new->pluginDefault[] = 'FilePondPluginImageCrop';

        return $new;
    }

    /**
     * Return new instance wheather enable or disable plugin image transform.
     */
    public function canBePluginImageTransform(): self
    {
        $new = clone $this;
        $new->pluginDefault[] = 'FilePondPluginImageTransform';

        return $new;
    }

    /**
     * Return new instance wheather enable or disable plugin PDF preview.
     */
    public function canBePluginPdfPreview(): self
    {
        $new = clone $this;
        $new->pluginDefault[] = 'FilePondPluginPdfPreview';

        return $new;
    }

    /**
     * Return new instance with the class name of the FilePond.
     *
     * @param string $value The class name of the FilePond. Default: `null`.
     */
    public function className(string $value): self
    {
        $new = clone $this;
        $new->options['className'] = $value;

        return $new;
    }

    /**
     * Return new instance with the environment asset. Default: `Prod`.
     *
     * @param string $value The environment asset. Default: `Prod`.
     */
    public function environmentAsset(string $value): self
    {
        if (!in_array($value, ['Cdn', 'Dev', 'Prod'])) {
            throw new InvalidArgumentException('Invalid environment asset: ' . $value . '.');
        }

        $new = clone $this;
        $new->environmentAsset = $value;

        return $new;
    }

    /**
     * Return new instance with number of files to load and display in the list.
     *
     * @param int $value The number of files to load and display in the list. Default: `null`.
     */
    public function maxFiles(int $value): self
    {
        $new = clone $this;
        $new->options['maxFiles'] = $value;

        return $new;
    }

    /**
     * Return new instance with the label shown to indicate this is a drop area. FilePond will automatically bind browse
     * file events to the element with CSS class.
     *
     * @param string $value The label shown to indicate this is a drop area.
     * Default: `Drag & Drop your files or <span class="filepond--label-action"> Browse </span>`.
     */
    public function labelIdle(string $value): self
    {
        $new = clone $this;
        $new->options['labelIdle'] = $value;

        return $new;
    }

    /**
     * Return new instance with the locale lenguage of FilePond.
     *
     * @param string $value The locale lenguage of FilePond. Default: ``.
     */
    public function locale(string $value): self
    {
        $new = clone $this;
        $new->locale = $value;

        return $new;
    }

    /**
     * Return new instance with set config options for FilePond.
     *
     * @param array $value The config options for FilePond. Default: `[]`.
     *
     * ```php
     * [
     *    'allowMultiple' => true,
     *    'maxFiles' => 3,
     *    'acceptedFileTypes' => ['image/png', 'image/jpeg', 'image/gif'],
     * ];
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;

        return $new;
    }

    /**
     * Return new instance with plugins default to register in FilePond.
     *
     * @param array $value The plugins default to register in FilePond. Default: `[]`.
     *
     * ```php
     * [
     *     'FilePondPluginFileEncode',
     *     'FilePondPluginFileValidateSize',
     *     'FilePondPluginFileValidateType',
     *     'FilePondPluginImageExifOrientation',
     *     'FilePondPluginImagePreview',
     * ];
     *
     * @psalm-param string[] $value
     */
    public function pluginDefault(array $value): self
    {
        $new = clone $this;
        $new->pluginDefault = $value;

        return $new;
    }

    /**
     * Return new instance wheather is required or not.
     *
     * @param bool $value Wheather is required or not. Default: `false`.
     */
    public function required(): static
    {
        $new = clone $this;
        $new->options['required'] = true;

        return $new;
    }

    /**
     * Returns a new instance specifying the translator instance.
     *
     * @param TranlatorInterface $value The translator instance.
     */
    public function translator(TranslatorInterface $value): self
    {
        $new = clone $this;
        $new->translator = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the webview instance.
     *
     * @param webView $value The webview instance.
     */
    public function webView(webView $value): self
    {
        $new = clone $this;
        $new->webView = $value;

        return $new;
    }

    protected function beforeRun(): bool
    {
        if ($this->assetManager === null) {
            throw new InvalidArgumentException('The `assetManager()` property must be set.');
        }

        if ($this->translator === null) {
            throw new InvalidArgumentException('The `translator()` property must be set.');
        }

        if ($this->webView === null) {
            throw new InvalidArgumentException('The `webView()` property must be set.');
        }

        $depends = [];

        foreach ($this->pluginDefault as $plugin) {
            $assetBundle = str_replace('FilePond', '', $plugin);
            $depends[] = 'Yii\FilePond\Asset' . '\\' . $assetBundle . $this->environmentAsset . 'Asset';
        }

        $this->assetManager->registerCustomized(
            'Yii\FilePond\Asset\FilePond' . $this->environmentAsset . 'Asset',
            ['depends' => $depends],
        );

        $this->webView->registerJs($this->getScript());

        return parent::beforeRun();
    }

    protected function run(): string
    {
        return $this->renderInputFile();
    }

    private function buildTranslation(): array
    {
        $translation = [];
        $translator = $this->translator;

        if ($this->locale !== '') {
            $translator = $translator->withLocale($this->locale);
        }

        foreach ($this->translationTagDefault as $tag) {
            if (array_key_exists($tag, $this->options) === false) {
                $translation[$tag] = $translator->translate($tag, [], $this->translationCategory);
            }
        }

        return $translation;
    }

    private function getScript(): string
    {
        $closure = $this->fileValidateTypeDetectType;
        $id = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        $options = array_merge($this->options, $this->buildTranslation());
        $pluginConfig = implode(', ', $this->pluginDefault);
        $setOptions = json_encode($options);

        return <<<JS
		FilePond.registerPlugin($pluginConfig);
		FilePond.setOptions($setOptions);
		FilePond.create(document.querySelector('input[type="file"][id="$id"]'), {
			$closure
		});
		JS;
    }

    /**
     * @return string the generated input tag.
     */
    private function renderInputFile(): string
    {
        $attributes = $this->attributes;

        if (array_key_exists('allowMultiple', $this->options) && $this->options['allowMultiple']) {
            $attributes['multiple'] = true;
        }

        if (array_key_exists('className', $this->options) && is_string($this->options['className'])) {
            $attributes['class'] = $this->options['className'];
        }

        if (array_key_exists('required', $this->options) && $this->options['required']) {
            $attributes['required'] = true;
        }

        CssClass::add($attributes, 'filepond');

        return File::widget([$this->formModel, $this->attribute])->attributes($attributes)->render();
    }
}
