## Plugin pdf preview

The PDF Preview plugin is an Extenxion of FilePond that will render a small preview when the uploaded file is of type PDF. It will use the browser native renderer.

### methods of the plugin

Method                         | Parameter | Description                                             | Default
-------------------------------|-----------|---------------------------------------------------------|---------
`allowPdfPreview()`            | `bool`    | Return new instance with enable or disable pdf preview. | `true`
`pdfPreviewHeight()`           | `string`  | Return new instance with pdf preview height.            | `320`
`pdfComponentExtraParams()`    | `string`   | Return new instance with pdf component extra params.    | `'toolbar=0&view=fit&page=1'`
