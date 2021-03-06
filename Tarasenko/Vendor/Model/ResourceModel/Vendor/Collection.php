<?php
namespace Tarasenko\Vendor\Model\ResourceModel\Vendor;
use Tarasenko\Vendor\Model\Vendor as Model;
use Tarasenko\Vendor\Model\ResourceModel as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    /**
     * Standard resource collection initialization
     */
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
