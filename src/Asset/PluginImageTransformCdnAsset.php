<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin image transform.
 */
final class PluginImageTransformCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [
        'https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js',
    ];
}
