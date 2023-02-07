## Plugin file validate size

The File Size Validation plugin handles blocking of files that are too large.

### methods of the plugin

Method                            | Parameter |Description                                                             | Default
----------------------------------|-----------|------------------------------------------------------------------------|---------
`allowFileSizeValidation()`       | `bool`    | Return new instance with enable or disable file size validation.       | `true`
`labelMaxFileSize()`              | `string`  | Return new instance with a new label for max files size.               | `'Maximum file size is {filesize}'`
`labelMaxFileSizeExceeded()`      | `string`  | Return new instance with a new label for max files size exceeded.      | `'Maximum file size exceeded'`
`labelMaxTotalFileSize()`         | `string`  | Return new instance with a new label for max total file size.          | `'Maximum total file size is {filesize}'`
`labelMaxTotalFileSizeExceeded()` | `string`  | Return new instance with a new label for max total file size exceeded. | `'Maximum total file size exceeded'`
`maxFileSize()`                   | `string`  | Return new instance with a new max file size.                          | `null`
`maxTotalFileSize()`              | `string`  | Return new instance with maximum size of all files.                    | `null`
`minFileSize()`                   | `int`     | Return new instance with minimum size of all files.                    | `null`
