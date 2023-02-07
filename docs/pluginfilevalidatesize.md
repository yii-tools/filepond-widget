## Plugin file validate size

The File Size Validation plugin handles blocking of files that are too large.

### methods of the plugin

Method                            | Description                                                               | Default
----------------------------------|---------------------------------------------------------------------------|---------
`allowFileSizeValidation()`       | Return new instance with enable or disable file size validation.          | `true`
`labelMaxFileSize()`              | Return new instance with a new label for max files size.                  | `'Maximum file size is {filesize}'`
`labelMaxFileSizeExceeded()`      | Return new instance with a new label for max files size exceeded.         | `'Maximum file size exceeded'`
`labelMaxTotalFileSize()`         | Return new instance with a new label for max total file size.             | `'Maximum total file size is {filesize}'`
`labelMaxTotalFileSizeExceeded()` | Return new instance with a new label for max total file size exceeded.    | `'Maximum total file size exceeded'`
`maxFileSize()`                   | Return new instance with a new max file size.                             | `null`
`maxTotalFileSize()`              | Return new instance with maximum size of all files.                       | `null`
`minFileSize()`                   | Return new instance with minimum size of all files.                       | `null`
