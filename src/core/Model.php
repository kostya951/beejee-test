<?php


abstract class Model
{
    public abstract function save();
    public abstract function load($params =[]);
}