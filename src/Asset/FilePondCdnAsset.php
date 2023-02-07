<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond file upload widget.
 */
final class FilePondCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $css = ['https://unpkg.com/filepond@^4/dist/filepond.min.css'];
    public array $js = ['https://unpkg.com/filepond@^4/dist/filepond.min.js'];
    public array $depends = [
        PluginFileEncodeCdnAsset::class,
        PluginFileValidateSizeCdnAsset::class,
        PluginFileValidateTypeCdnAsset::class,
        PluginImageExifOrientationCdnAsset::class,
        PluginImagePreviewCdnAsset::class,
    ];
}
