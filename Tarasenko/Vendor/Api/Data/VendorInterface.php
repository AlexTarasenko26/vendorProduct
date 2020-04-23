<?php
namespace Tarasenko\Vendor\Api\Data;

interface VendorInterface{

    /**
     * @return int
     */
    public function getVendorId();

    /**
     * @param int $id
     *
     * @return VendorInterface
     */
    public function setVendorId($id);

    /**
     * @return string
     */
    public function getVendorName();

    /**
     * @param string $name
     *
     * @return VendorInterface
     */
    public function setVendorName($name);
}
