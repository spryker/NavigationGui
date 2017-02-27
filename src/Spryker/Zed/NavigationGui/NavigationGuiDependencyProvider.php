<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\NavigationGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\NavigationGui\Dependency\Facade\NavigationGuiToLocaleBridge;
use Spryker\Zed\NavigationGui\Dependency\Facade\NavigationGuiToNavigationBridge;
use Spryker\Zed\NavigationGui\Dependency\Facade\NavigationGuiToUrlBridge;
use Spryker\Zed\NavigationGui\Dependency\QueryContainer\NavigationGuiToCmsBridge;
use Spryker\Zed\NavigationGui\Dependency\QueryContainer\NavigationGuiToNavigationBridge as NavigationGuiToNavigationQueryContainerBridge;

class NavigationGuiDependencyProvider extends AbstractBundleDependencyProvider
{

    const FACADE_NAVIGATION = 'FACADE_NAVIGATION';
    const FACADE_LOCALE = 'FACADE_LOCALE';
    const FACADE_URL = 'FACADE_URL';

    const QUERY_CONTAINER_NAVIGATION = 'QUERY_CONTAINER_NAVIGATION';
    const QUERY_CONTAINER_CMS = 'QUERY_CONTAINER_CMS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $this->provideNavigationFacade($container);
        $this->provideLocaleFacade($container);
        $this->provideUrlFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $this->provideNavigationQueryContainer($container);
        $this->provideCmsQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function provideNavigationFacade(Container $container)
    {
        $container[self::FACADE_NAVIGATION] = function (Container $container) {
            return new NavigationGuiToNavigationBridge($container->getLocator()->navigation()->facade());
        };
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function provideLocaleFacade(Container $container)
    {
        $container[self::FACADE_LOCALE] = function (Container $container) {
            return new NavigationGuiToLocaleBridge($container->getLocator()->locale()->facade());
        };
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function provideUrlFacade(Container $container)
    {
        $container[self::FACADE_URL] = function (Container $container) {
            return new NavigationGuiToUrlBridge($container->getLocator()->url()->facade());
        };
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function provideNavigationQueryContainer(Container $container)
    {
        $container[self::QUERY_CONTAINER_NAVIGATION] = function (Container $container) {
            return new NavigationGuiToNavigationQueryContainerBridge($container->getLocator()->navigation()->queryContainer());
        };
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function provideCmsQueryContainer(Container $container)
    {
        $container[self::QUERY_CONTAINER_CMS] = function (Container $container) {
            return new NavigationGuiToCmsBridge($container->getLocator()->cms()->queryContainer());
        };
    }

}
