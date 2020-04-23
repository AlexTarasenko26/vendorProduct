<?php
namespace Tarasenko\Vendor\Model\ResourceModel;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class VendorProduct extends AbstractDb{

    protected function _construct()
    {
        $this->_init('vendor2product','vendor_id');
    }

    /**
     * Get vendors by product Id
     *
     * @param int $productId
     * @return array
     * @throws LocalizedException
     */
    public function getVendors(int $productId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()
                                ->from($this->getMainTable(), ['vendor_id'])
                                ->where('product_id = ?', $productId
        );

        $rowset = $this->getConnection()->fetchAll($select);

        $result = [];
        foreach ($rowset as $row) {
            array_push($result, $row['vendor_id']);
        }

        return $result;
    }
}
