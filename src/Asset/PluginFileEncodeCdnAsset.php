<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin file encode.
 */
final class PluginFileEncodeCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = ['https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'];
}
