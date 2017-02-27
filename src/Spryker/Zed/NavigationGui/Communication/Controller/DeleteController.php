<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\NavigationGui\Communication\Controller;

use Generated\Shared\Transfer\NavigationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\NavigationGui\Communication\NavigationGuiCommunicationFactory getFactory()
 */
class DeleteController extends AbstractController
{

    const PARAM_ID_NAVIGATION = 'id-navigation';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $idNavigation = $this->castId($request->query->getInt(self::PARAM_ID_NAVIGATION));

        $navigationTransfer = new NavigationTransfer();
        $navigationTransfer->setIdNavigation($idNavigation);
        $navigationTransfer = $this->getFactory()
            ->getNavigationFacade()
            ->findNavigation($navigationTransfer);

        if ($navigationTransfer) {
            $this->getFactory()
                ->getNavigationFacade()
                ->deleteNavigation($navigationTransfer);

            $this->addSuccessMessage(sprintf('Navigation #%d successfully deleted.', $idNavigation));
        } else {
            $this->addErrorMessage(sprintf('Navigation #%d not found.', $idNavigation));
        }

        return $this->redirectResponse('/navigation-gui');
    }

}