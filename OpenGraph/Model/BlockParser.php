<?php

declare(strict_types=1);


namespace Codilar\OpenGraph\Model;

use Magento\Cms\Api\BlockRepositoryInterface;

/**
 * Class BlockParser
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Model
 * @author   Codilar ThriveOn Team <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 */
class BlockParser
{
    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    public function __construct(
        BlockRepositoryInterface $blockRepository
    ) {
        $this->blockRepository = $blockRepository;
    }

    /**
     * Method to fetch the Content of Block
     *
     * @param  int $blockId
     * @return string
     */
    public function getBlockContentById(int $blockId) : string
    {
        try {
            $cmsBlock = $this->blockRepository->getById($blockId);
            return html_entity_decode($cmsBlock->getData('content')) ?? '';
        } catch (\Exception $e) {
            return '';
        }
    }
}
