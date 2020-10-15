<?php

namespace ignatenkovnikita\yandexsprav\actions;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use ignatenkovnikita\yandexsprav\interfaces\YandexSpravProduct;

class GenerateAction extends \yii\base\Action
{

    public $fileName;
    public $publicPath;
    public $runtimePath;
    public $query;

    public function run()
    {
        $fileName = \Yii::getAlias($this->runtimePath) . DIRECTORY_SEPARATOR . $this->fileName;


        $writer = WriterEntityFactory::createXLSXWriter();
// $writer = WriterEntityFactory::createODSWriter();
// $writer = WriterEntityFactory::createCSVWriter();

        $writer->openToFile($fileName); // write data to a file or to a PHP stream
//$writer->openToBrowser($fileName); // stream data directly to the browser

        $header = [
            WriterEntityFactory::createCell('Категория'),
            WriterEntityFactory::createCell('Название'),
            WriterEntityFactory::createCell('Описание'),
            WriterEntityFactory::createCell('Цена'),
            WriterEntityFactory::createCell('Фото'),
            WriterEntityFactory::createCell('Популярный товар'),
            WriterEntityFactory::createCell('В наличии'),


        ];
        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow);


        foreach ($this->query->each() as $item) {
            /** @var YandexSpravProduct $item  */

            $cells = [
                WriterEntityFactory::createCell($item->getYandexCategory()),
                WriterEntityFactory::createCell($item->getYandexName()),
                WriterEntityFactory::createCell($item->getYandexName()),
                WriterEntityFactory::createCell($item->getYandexPrice()),
                WriterEntityFactory::createCell($item->getYandexImage()),
                WriterEntityFactory::createCell($item->getYandexIsPopular()),
                WriterEntityFactory::createCell($item->getYandexInStock()),
            ];

            /** add a row at a time */
            $singleRow = WriterEntityFactory::createRow($cells);
            $writer->addRow($singleRow);

        }


//        /** add multiple rows at a time */
//        $multipleRows = [
//            WriterEntityFactory::createRow($cells),
//            WriterEntityFactory::createRow($cells),
//        ];
//        $writer->addRows($multipleRows);

        /** Shortcut: add a row from an array of values */
//        $values = ['Carl', 'is', 'great!'];
//        $rowFromValues = WriterEntityFactory::createRowFromArray($values);
//        $writer->addRow($rowFromValues);

        $writer->close();


        $publicPath = \Yii::getAlias($this->publicPath);
        rename($fileName, $publicPath . DIRECTORY_SEPARATOR . basename($fileName));


    }
}