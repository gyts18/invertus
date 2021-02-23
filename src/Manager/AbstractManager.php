<?php

namespace Project\Manager;

/**
 * To be more exact this should be used, if there are many types of different CartManagers available maybe for different platforms?
 */
abstract class AbstractManager
{
    abstract protected function processProducts(): void;
}