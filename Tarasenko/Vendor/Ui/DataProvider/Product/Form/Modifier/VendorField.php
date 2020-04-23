<?php
namespace Tarasenko\Vendor\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Tarasenko\Vendor\Model\VendorProduct;
use Tarasenko\Vendor\Api\Data\VendorFactoryInterface;

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
     * @var VendorFactoryInterface
     */
    private $vendorFactory;

    /**
     * Fields constructor.
     *
     * @param LocatorInterface $locator
     * @param VendorProduct $vendorProduct
     * @param VendorFactoryInterface $vendorFactory
     */
    public function __construct(
        LocatorInterface $locator,
        VendorProduct $vendorProduct,
        VendorFactoryInterface $vendorFactory
    ) {
        $this->locator = $locator;
        $this->vendorProduct = $vendorProduct;
        $this->vendorFactory = $vendorFactory;
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
        $vendorIds = $this->vendorProduct->getVendors($productId);
        if (empty($vendorIds)){

            return $data;
        }
        $result = [];
        $vendorModel = $this->vendorFactory->create();
        foreach ($vendorIds as $vendorId){
           $vendorModel->load($vendorId);
           $result[] = ['value' => $vendorId, 'label' => $vendorModel->getVendorName()];
        }

        $data[strval($productId)]['vendor']['vendorname'] = $result;

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
                            'options'       => [
                                ['value' => '0', 'label' => __('Nike')],
                                ['value' => '1', 'label' => __('Puma')]
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }
}
