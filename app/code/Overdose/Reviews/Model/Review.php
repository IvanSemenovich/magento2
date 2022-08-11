<?php

namespace Overdose\Reviews\Model;

class Review extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'overdose_reviews_review';

    protected $_cacheTag = 'overdose_reviews_review';

    protected $_eventPrefix = 'overdose_reviews_review';

    protected function _construct()
    {
        $this->_init('Overdose\Reviews\Model\ResourceModel\Review');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
