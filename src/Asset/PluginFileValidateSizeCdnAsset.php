<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin file validate size.
 */
final class PluginFileValidateSizeCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [
        'https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js',
    ];
}
