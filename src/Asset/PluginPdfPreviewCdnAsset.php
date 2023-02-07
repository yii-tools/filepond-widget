<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin image transform.
 */
final class PluginPdfPreviewCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $css = ['https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css'];
    public array $js = ['https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js'];
}
