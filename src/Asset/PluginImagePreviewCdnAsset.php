<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Content delivery network asset bundle for the Filepond plugin image preview.
 */
final class PluginImagePreviewCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $css = ['https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'];
    public array $js = ['https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js'];
}
