<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests\Support;

use Yii\Support\Assert;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Test\Support\EventDispatcher\SimpleEventDispatcher;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\IntlMessageFormatter;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

trait TestTrait
{
    protected AssetPublisher $assetPublisher;
    private Aliases $aliases;
    private AssetManager $assetManager;
    private WebView $webView;
    private TranslatorInterface $translator;

    /**
     * @throws InvalidConfigException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->aliases = new Aliases(
            [
                '@root' => dirname(__DIR__, 2),
                '@npm' => '@root/node_modules',
                '@assetsUrl' => '/',
                '@assets' => __DIR__ . '/runtime',
                '@filepond' => '@root',
            ],
        );
        $this->assetManager = new AssetManager($this->aliases, new AssetLoader($this->aliases, false, []));
        $this->assetPublisher = new AssetPublisher($this->aliases);
        $this->assetManager = $this->assetManager->withPublisher($this->assetPublisher);
        $this->webView = new WebView(dirname(__DIR__) . '/runtime', new SimpleEventDispatcher());
        $this->translator = $this->createTranslator();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Assert::removeFilesFromDirectory($this->aliases->get('@assets'));
    }

    private function createConfigCategorySource(): CategorySource
    {
        $aliases = $this->aliases;
        $params = require $aliases->get('@root/config/params.php');

        return new CategorySource(
            $params['yii-tools/filepond-widget']['translator']['defaultCategory'],
            new MessageSource($aliases->get($params['yii-tools/filepond-widget']['translator']['path'])),
            new IntlMessageFormatter(),
        );
    }

    private function createTranslator(): TranslatorInterface
    {
        $translator = new Translator('en');

        $translator->addCategorySources($this->createConfigCategorySource());
        return $translator->withDefaultCategory('filepond');
    }
}
