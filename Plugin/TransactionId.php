<?php

namespace GetNoticed\VsfMollie\Plugin;

use GetNoticed\VsfMollie\Api\MollieOrderRepositoryInterface;

class TransactionId {

    /**
     * @var MollieOrderRepositoryInterface
     */
    private $mollieOrderRepository;

    /**
     * TransactionId constructor.
     * @param MollieOrderRepositoryInterface $mollieOrderRepository
     */
    public function __construct(
        MollieOrderRepositoryInterface $mollieOrderRepository
    ) {
        $this->mollieOrderRepository = $mollieOrderRepository;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $subject
     * @param                                        $result
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetMollieTransactionId(
        \Magento\Sales\Api\Data\OrderInterface $subject,
        $result
    ) {
        $mollieOrder = $this->mollieOrderRepository->getByOrder($subject);
        return $mollieOrder->getMollieTransactionId();
    }

}
