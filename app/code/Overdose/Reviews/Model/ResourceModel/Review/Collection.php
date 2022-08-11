<?php

namespace Overdose\Reviews\Model\ResourceModel\Review;

class Collection  extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'overdose_reviews_review_collection';
    protected $_eventObject = 'review_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Overdose\Reviews\Model\Review', 'Overdose\Reviews\Model\ResourceModel\Review');
    }

}
