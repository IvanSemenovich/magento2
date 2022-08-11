<?php

namespace Overdose\Reviews\Model\ResourceModel;

class Review extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('reviews_table', 'entity_id');
    }
}
