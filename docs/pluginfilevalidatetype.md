## Plugin file validate type

The File Type Validation plugin handles blocking of files that are of the wrong type.

When creating a FilePond instance based on a input type file, this plugin will automatically interpret the accept attribute value.

### methods of the plugin

Method                                    | Description                                                                    | Default
------------------------------------------|--------------------------------------------------------------------------------|---------
`allowFileTypeValidation()`               | Return new instance with enable or disable file type validation.               | `true`
`acceptedFileTypes()`                     | Return new instance with accepted file types. Can be mime types or wild cards. | `[]`
`fileValidateTypeDetectType()`            | Return new instance specifies function that receives a file and the type detected by `FilePond::class`, should return a `Promise` resolve with detected file type, reject if can't detect. | `null`
`fileValidateTypeLabelExpectedTypes()`    | Return new instance with message shown to indicate the allowed file types.     | `'Expects {allButLastType} or {lastType}'`
`fileValidateTypeLabelExpectedTypesMap()` | Return new instance allows mapping the file type to a more visually appealing label, { 'image/jpeg': '.jpg' } will show .jpg in the expected types label. Set to null to hide a type from the label. | `[]`
`labelFileTypeNotAllowed()`               | Return new instance with label for file type not allowed error.                | `'File type not allowed'`

