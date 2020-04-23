<?php
namespace Tarasenko\Vendor\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class Vendor extends AbstractDb{

    protected function _construct()
    {
        $this->_init('vendor','vendor_id');
    }
}
