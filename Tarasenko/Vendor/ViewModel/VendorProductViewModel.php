<?php
namespace Tarasenko\Vendor\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Tarasenko\Vendor\Model\ResourceModel\VendorProduct as Resource;
use Tarasenko\Vendor\Model\ResourceModel\Vendor as Vendor;

class VendorProductViewModel implements  ArgumentInterface{

    private $resource;
    private $vendor;

    public function __construct(
        Resource $resource,
        Vendor $vendor
    )
    {
        $this->resource = $resource;
        $this->vendor = $vendor;
    }

    public function getVendorsByProductId(int $productId){

        return $this->resource->getVendors($productId);
    }
}
