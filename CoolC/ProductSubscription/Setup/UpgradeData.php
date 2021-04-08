<?php

namespace CoolC\ProductSubscription\Setup;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

/**
 * Class UpgradeData
 * @package CoolC\ProductSubscription\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;


    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * UpgradeData constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param State $state
     * @param CategorySetupFactory $categorySetupFactory
     * @throws LocalizedException
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        State $state,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->state = $state;
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $this->storeManager = $storeManager;
        $this->catalogSetupFactory = $categorySetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Exception
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {

            $attributeName = 'subscription';
            /** @var \Magento\Catalog\Setup\CategorySetup $categorySetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);

            $catalogSetup->addAttribute(Product::ENTITY, $attributeName, [
                'type' => 'int',
                'label' => 'Display Subscription on product page',
                'input' => 'select',
                'required' => false,
                'sort_order' => 10,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'wysiwyg_enabled' => false,
                'is_html_allowed_on_front' => false,
                'group' => 'Subscription details',
                'default' => 1,
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'note' => 'Display Subscription on product page.'
            ]);
        }
        $setup->endSetup();
    }
}
