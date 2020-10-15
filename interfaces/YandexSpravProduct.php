<?php
namespace ignatenkovnikita\yandexsprav\interfaces;


interface YandexSpravProduct
{

    public function getYandexCategory();
    public function getYandexName();
    public function getYandexDescription();
    public function getYandexPrice();
    public function getYandexImage();
    public function getYandexIsPopular();
    public function getYandexInStock();

}