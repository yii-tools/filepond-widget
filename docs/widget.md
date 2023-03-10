# FilePond widget

The widget is a wrapper for the [filepond](https://pqina.nl/filepond/), which allows you to upload files to the server. 

The assets are registered in the view automatically when the widget is used.

The widget translation is done automatically if you use [locale](https://github.com/yiisoft/yii-middleware/blob/master/src/Locale.php) middleware,
otherwise you need to setter locale in the widget `FilePond::widget([$form, 'attachment'])->locale('en')`. You must set the `assetManager` part `Yiisoft\Assets\AssetManager::class`, `view` part `Yiisoft\View\WebView::class` and `translator` part `Yiisoft\Translator\TranslatorInterface::class`.

**Info:** *Must set in the view the `assetManager` part `Yiisoft\Assets\AssetManager::class` and  `translator` part `Yiisoft\Translator\TranslatorInterface:class` in common params config file.*

## Example config params

```php
<?php

declare(strict_types=1);

use Yiisoft\Assets\AssetManager;
use Yiisoft\Definitions\Reference;
use Yiisoft\Translator\TranslatorInterface;

return [
    // View
    'yiisoft/view' => [
        'parameters' => [
            'assetManager' => Reference::to(AssetManager::class),
    	    'translator' => Reference::to(TranslatorInterface::class),
        ],
    ],
];
```

### Example of usage simple in the view

```php
<?php

declare(strict_types=1);

use Yii\FilePond\FilePond;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \Yiisoft\Translator\TranslatorInterface $translator
 * @var \Yiisoft\View\WebView $this
 */ 
?>

<?= FilePond::widget([$form, 'attachment'])
    ->acceptedFileTypes(['image/*'])
    ->allowMultiple(true)
    ->assetManager($assetManager)
    ->imagePreviewMarkupShow(false)
    ->imagePreviewTransparencyIndicator('#FFFFFF')
    ->maxFiles(3)
    ->maxFileSize('10MB')
    ->translator($translator)
    ->webView($this),
?>
```

### Example of usage with `Field::class` in the view

```php
<?php

declare(strict_types=1);

use Yii\FilePond\FilePond;
use Yii\Forms\Component\Field;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \Yiisoft\Translator\TranslatorInterface $translator
 * @var \Yiisoft\View\WebView $this
 */ 
?>

<?= Field::widget(
    [
        FilePond::widget([$form, 'attachment'])
            ->acceptedFileTypes(['image/*'])
            ->allowMultiple(true)
            ->assetManager($assetManager)
            ->imagePreviewMarkupShow(false)
            ->imagePreviewTransparencyIndicator('#FFFFFF')
            ->maxFiles(3)
            ->maxFileSize('10MB')
            ->translator($translator)
            ->webView($this),
    ],
)->notLabel() ?>
```

### Example of usage in the form model for save uploaded files

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Yii\Forms\Helper\FilePondHelper;
use Yii\FormModel\AbstractFormModel;

/**
 * The contact form model is used to collect user input on the contact page.
 */
final class ContactForm extends AbstractFormModel
{
    private array $attachment = [];
    private string $email = '';
    private string $message = '';
    private string $name = '';
    private string $pathUploadFile = '';
    private string $subject = '';
    /** @psalm-var string[] */
    private array $saveFiles = [];

    public function clear(): void
    {
        $this->attachment = [];
        $this->email = '';
        $this->message = '';
        $this->name = '';
        $this->subject = '';
        $this->saveFiles = [];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @psalm-return string[]
     */
    public function getSaveFiles(): array
    {
        return $this->saveFiles;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function load(array $data, string $formName = null): bool
    {
        $result = parent::load($data, $formName);

        if ($result && $this->pathUploadFile !== '') {
            /** @psalm-var string[] */
            $this->saveFiles = FilePondHelper::saveWithReturningFiles($this->attachment, $this->pathUploadFile);
        }

        return $result;
    }

    public function setPathUploadFile(string $pathUploadFile): void
    {
        $this->pathUploadFile = $pathUploadFile;
    }
}
```

### Example of usage in the controller

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Http\Method;

final class ContactAction
{
    public function run(Aliases $aliases, ServerRequestInterface $serverRequest): ResponseInterface
    {
        /** @psalm-var array<string, mixed> */
        $body = $serverRequest->getParsedBody();
        $method = $serverRequest->getMethod();

        $contactForm = new ContactForm();
        $contactForm->setPathUploadFile($aliases->get('@runtime/uploaded'));

        if ($method === Method::POST && $contactForm->load($body)) {
            $uploadedFiles = $contactForm->getSaveFiles();

            // your code here ...
        }

        // your code here ...
    }
}
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                    | Description                                                                           | Default                                                                          |
|---------------------------|---------------------------------------------------------------------------------------|----------------------------------------------------------------------------------|
| `allowMultiple()`         | Return new instance with enable or disable multiple file upload.                      | `true`                                                                           |
| `assetManager()`          | Return new instance with the asset manager.                                           | `null`                                                                           |
| `canBePluginImageCrop()`  | Return new instance whether enable or disable plugin image crop.                      | `''`                                                                             |
| `canBePluginPdfPreview()` | Return new instance whether enable or disable plugin PDF preview.                     | `''`                                                                             |
| `className()`             | Return new instance with the class name of the FilePond.                              | `null`                                                                           |
| `environmentAsset()`      | Return new instance with the environment asset. Values allowed: `Cdn`, `Dev`, `Prod`. | `Prod`                                                                           |
| `maxFiles()`              | Return new instance with number of files to load and display in the list.             | `null`                                                                           |
| `labelIdle()`             | Return new instance with the label shown to indicate this is a drop area.             | `'Drag & Drop your files or <span class="filepond--label-action">Browse</span>'` |
| `options()`               | Return new instance with set config options for FilePond.                             | `[]`                                                                             |
| `pluginDefault()`         | Return new instance with the default plugin.                                          | see more below                                                                   |
| `required()`              | Return new instance with enable or disable required.                                  | `false`                                                                          |
| `translator()`            | Return new instance with the translator.                                              | `null`                                                                           |
| `webView()`               | Return new instance with the web view.                                                | `null`                                                                           |

#### Plugin default

```php
[
    'FilePondPluginFileEncode',
    'FilePondPluginFileValidateSize',
    'FilePondPluginFileValidateType',
    'FilePondPluginImageExifOrientation',
    'FilePondPluginImagePreview',
]
```

- [Plugin File Validate Size](/docs/pluginfilevalidatesize.md)
- [Plugin File Validate Type](/docs/pluginfilevalidatetype.md)
- [Plugin Image Crop](/docs/pluginimagecrop.md)
- [Plugin Image Exif Orientation](/docs/pluginimageexiforientation.md)
- [Plugin Image Preview](/docs/pluginimagepreview.md)
- [Plugin Image Transform](/docs/pluginimagetransform.md)
- [Plugin PDF Preview](/docs/pluginpdfpreview.md)
