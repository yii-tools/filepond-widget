<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin file validate size.
 */
final class PluginFileValidateTypeCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = ['dist/filepond-plugin-file-validate-type.min.js'];
}
