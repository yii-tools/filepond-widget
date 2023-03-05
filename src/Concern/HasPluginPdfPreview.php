<?php

declare(strict_types=1);

namespace Yii\FilePond\Concern;

/**
 * Provides methods for managing the plugin pdf preview.
 */
trait HasPluginPdfPreview
{
    /**
     * Return new instance with enabled or disable pdf preview.
     *
     * @param bool $value Enable or disable pdf preview. Default: `true`.
     */
    public function allowPdfPreview(bool $value): self
    {
        $new = clone $this;
        $new->options['allowPdfPreview'] = $value;

        return $new;
    }

    /**
     * Return new instance with pdf preview height.
     *
     * @param int $value Pdf preview height. Default: `320`.
     */
    public function pdfPreviewHeight(int $value): self
    {
        $new = clone $this;
        $new->options['pdfPreviewHeight'] = $value;

        return $new;
    }

    /**
     * Return new instance with pdf part extra params.
     *
     * @param string $value Pdf part extra params. Default: `'toolbar=0&view=fit&page=1'`.
     */
    public function pdfComponentExtraParams(string $value): self
    {
        $new = clone $this;
        $new->options['pdfComponentExtraParams'] = $value;

        return $new;
    }
}
