<?php
declare(strict_types=1);
namespace Tarasenko\Vendor\Model;
use Magento\Framework\Model\AbstractModel;
use Tarasenko\Vendor\Api\Data\VendorInterface;
use Tarasenko\Vendor\Model\ResourceModel\Vendor as ResourceModel;
class Vendor extends AbstractModel implements VendorInterface {

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
     * @return int
     */
    public function getVendorId()
    {
        return $this->getData('vendor_id');
    }

    /**
     * @param int $id
     *
     * @return VendorInterface
     */
    public function setVendorId($id)
    {
        return $this->setData('vendor_id', $id);
    }

    /**
     * @return string
     */
    public function getVendorName()
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     *
     * @return VendorInterface
     */
    public function setVendorName($name)
    {
        return $this->setData('name', $name);
    }

}
