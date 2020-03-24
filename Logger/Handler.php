<?php


namespace Codilar\OpenGraph\Logger;

use Monolog\Logger;

/**
 * Class Handler
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Handler for Logger
 */

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/codilar_opengraph_log.log';
}
