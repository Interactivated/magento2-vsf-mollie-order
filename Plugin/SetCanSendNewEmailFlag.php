<?php

namespace GetNoticed\VsfMollie\Plugin;

class SetCanSendNewEmailFlag {

    public function afterInitialize(
        $subject,
        $result
    ) {
        $payment = $subject->getInfoInstance();
        /** @var \Magento\Sales\Model\Order $order */
        $order = $payment->getOrder();
        $order->setCanSendNewEmailFlag(true);
    }

}
