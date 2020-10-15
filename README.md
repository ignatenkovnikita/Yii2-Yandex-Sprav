Yii2 Yandex Export Product
==========================
Yii2 Yandex Export Product

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ignatenkovnikita/yii2-yandexsprav "*"
```

or add

```
"ignatenkovnikita/yii2-yandexsprav": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Add Action eexample:


```php
public function actions()
{
    return [
        'generate' => [
            'class' => GenerateAction::className(),
            'fileName' => 'xls-yandex-sprav.xlsx', # желаемое название файла
            'publicPath' => '@frontend/web', # публичная директория (обычно корень веб сервера)
            'runtimePath' => '@runtime', # временная директория
            'query' => Product::find()->showOnSite(),
        ],
    ];
}```