<?php
declare(strict_types=1);


namespace Codilar\OpenGraph\Model;

interface AdapterInterface
{
    /**
     * @return \Codilar\OpenGraph\Model\Property
     */
    public function getProperty();
}
