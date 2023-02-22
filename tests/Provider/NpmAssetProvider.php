<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests\Provider;

use Yii\FilePond\Asset;

final class NpmAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public static function assetBundles(): array
    {
        return [
            [
                'Css',
                Asset\FilePondDevAsset::class,
            ],
            [
                'Css',
                Asset\PluginImagePreviewDevAsset::class,
            ],
            [
                'Css',
                Asset\FilePondProdAsset::class,
            ],
            [
                'Css',
                Asset\PluginImagePreviewProdAsset::class,
            ],
            [
                'Js',
                Asset\FilePondDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileEncodeDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateSizeDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateTypeDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageCropDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageExifOrientationDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginImagePreviewDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageTransformDevAsset::class,
            ],
            [
                'Js',
                Asset\PluginPdfPreviewDevAsset::class,
            ],
            [
                'Js',
                Asset\FilePondProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileEncodeProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateSizeProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateTypeProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageCropProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageExifOrientationProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginImagePreviewProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageTransformProdAsset::class,
            ],
            [
                'Js',
                Asset\PluginPdfPreviewProdAsset::class,
            ],
        ];
    }
}
