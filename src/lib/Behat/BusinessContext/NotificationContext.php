<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformAdminUi\Behat\BusinessContext;

use EzSystems\EzPlatformAdminUi\Behat\PageElement\ElementFactory;
use EzSystems\EzPlatformAdminUi\Behat\PageElement\Notification;
use PHPUnit\Framework\Assert;

/** Context for actions on notifications */
class NotificationContext extends BusinessContext
{
    /**
     * @Then notification that :itemType :itemName is :action appears
     */
    public function notificationAppears(string $itemType, ?string $itemName = null, string $action): void
    {
        $notification = ElementFactory::createElement($this->utilityContext, Notification::ELEMENT_NAME);
        $notification->verifyVisibility();
        $notification->verifyAlertSuccess();
        $msg = !$itemName ? sprintf('%s %s.', $itemType, $action) : sprintf('%s \'%s\' %s.', $itemType, $itemName, $action);
        Assert::assertEquals($msg, $notification->getMessage());
    }

    /**
     * @Then success notification that :message appears
     */
    public function specificNotificationAppears(string $message): void
    {
        $notification = ElementFactory::createElement($this->utilityContext, Notification::ELEMENT_NAME);
        $notification->verifyVisibility();
        $notification->verifyAlertSuccess();
        Assert::assertEquals($message, $notification->getMessage());
    }

    /**
     * @Then error notification that :message appears
     */
    public function specificErrorNotificationAppears(string $message): void
    {
        $notification = ElementFactory::createElement($this->utilityContext, Notification::ELEMENT_NAME);
        $notification->verifyVisibility();
        $notification->verifyAlertFailure();
        Assert::assertContains($message, $notification->getMessage());
    }
}
