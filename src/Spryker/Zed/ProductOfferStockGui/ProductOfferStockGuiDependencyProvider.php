<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferStockGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductOfferStockGui\Dependency\Facade\ProductOfferStockGuiToProductOfferStockFacadeBridge;

/**
 * @method \Spryker\Zed\ProductOfferStockGui\ProductOfferStockGuiConfig getConfig()
 */
class ProductOfferStockGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_OFFER_STOCK = 'FACADE_PRODUCT_OFFER_STOCK';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_OFFER_STOCK_TABLE_EXPANDER = 'PLUGINS_PRODUCT_OFFER_STOCK_TABLE_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addProductOfferStockFacade($container);
        $container = $this->addProductOfferStockTableExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductOfferStockFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT_OFFER_STOCK, function (Container $container) {
            return new ProductOfferStockGuiToProductOfferStockFacadeBridge(
                $container->getLocator()->productOfferStock()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductOfferStockTableExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_OFFER_STOCK_TABLE_EXPANDER, function () {
            return $this->getProductOfferStockTableExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferStockGuiExtension\Dependeency\Plugin\ProductOfferStockTableExpanderPluginInterface>
     */
    protected function getProductOfferStockTableExpanderPlugins(): array
    {
        return [];
    }
}
