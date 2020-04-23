<?php
namespace Tarasenko\Vendor\Model;
use Magento\Framework\Model\AbstractModel;
use Tarasenko\Vendor\Model\ResourceModel\VendorProduct as ResourceModel;

class VendorProduct extends AbstractModel{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getVendors($productId)
    {
        return $this->getResource()->getVendors($productId);
    }

}
