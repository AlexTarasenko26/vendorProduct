<?php
namespace Tarasenko\Vendor\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Tarasenko\Vendor\Model\VendorProduct;
use Tarasenko\Vendor\Model\VendorFactory;

class VendorField extends AbstractModifier{
    /**
     * @var LocatorInterface
     */
    private $locator;

    /**
     * @var VendorProduct
     */
    private $vendorProduct;

    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    protected $vendors = [];
    /**
     * Fields constructor.
     *
     * @param LocatorInterface $locator
     * @param VendorProduct $vendorProduct
     * @param VendorFactory $vendorFactory
     */
    public function __construct(
        LocatorInterface $locator,
        VendorProduct $vendorProduct,
        VendorFactory $vendorFactory
    ) {
        $this->locator = $locator;
        $this->vendorProduct = $vendorProduct;
        $this->vendorFactory = $vendorFactory;
        $this->initVendors();
    }

    protected function initVendors()
    {

        $product   = $this->locator->getProduct();
        $productId = $product->getId();
        $vendorIds = $this->vendorProduct->getVendors($productId);
        $this->vendors = [];
        $vendorModel = $this->vendorFactory->create();
        foreach ($vendorIds as $vendorId){
            $vendorModel->load($vendorId);
            $this->vendors[] = ['value' => $vendorId, 'label' => $vendorModel->getVendorName()];
        }
    }

    /**
     * @param array $data
     * @return array
     * @since 100.1.0
     */
    public function modifyData(array $data)
    {
        $product   = $this->locator->getProduct();
        $productId = $product->getId();

        if (empty($this->vendors)){

            return $data;
        }

        $data[strval($productId)]['vendor']['vendorname'] = $this->vendors;

        return $data;

    }

    /**
     * @param array $meta
     * @return array
     * @since 100.1.0
     */
    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'vendor' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Vendor'),
                                'collapsible' => true,
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.vendorname',
                                'sortOrder' => 10
                            ],
                        ],
                    ],
                    'children' => $this->getFields()
                ],
            ]
        );

        return $meta;
    }

    protected function getFields()
    {
        return [
            'vendorname'  => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __('Vendor name'),
                            'componentType' => Field::NAME,
                            'formElement'   => Select::NAME,
                            'dataScope'     => 'data.vendorname',
                            'dataType'      => Text::NAME,
                            'sortOrder'     => 10,
                            'options'       => $this->vendors
                        ],
                    ],
                ],
            ]
        ];
    }
}
