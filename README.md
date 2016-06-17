Yii2-review
==========
Модуль добавления отзывов для товара.

Установка
---------------------------------
Выполнить команду

```
php composer require pistol88/yii2-review "*"
```

Или добавить в composer.json

```
"pistol88/yii2-review": "*",
```

И выполнить

```
php composer update
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/pistol88/yii2-review/migrations
```

Подключение и настройка
---------------------------------
В конфигурационный файл приложения добавить модуль review

```php
    'modules' => [
        'review' => [
            'class' => 'pistol88\review\Module',
        ],
        //...
    ]
```

Виджеты
---------------------------------
За вывод формы заказа отвечает виджет pistol88\review\widgets\ReviewForm

```php
<?php
use pistol88\review\widgets\ReviewList;
use pistol88\review\widgets\ReviewForm;
?>

Выведет список отзывов о переданном продукте:
<?=ReviewList::widget(['itemId' => $model->id]);?>

Выведет форму добавления отзыва о продукте:
<?=ReviewForm::widget(['model' => $model]);?>
```
