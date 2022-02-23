<?php

namespace GetNoticed\VsfMollie\Plugin;

use GetNoticed\VsfMollie\Api\MollieOrderRepositoryInterface;
use GetNoticed\VsfMollie\Api\Data\MollieOrderInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GetOrderByTransactionId {

    /**
     * @var MollieOrderRepositoryInterface
     */
    private $mollieOrderRepository;

    /**
     * GetOrderByTransactionId constructor.
     * @param MollieOrderRepositoryInterface $mollieOrderRepository
     */
    public function __construct(
        MollieOrderRepositoryInterface $mollieOrderRepository
    ) {
        $this->mollieOrderRepository = $mollieOrderRepository;
    }

    /**
     * @param Mollie\Payment\Model\Mollie $subject
     * @param                             $result
     * @param string                      $transactionId
     * @return bool|int
     */
    public function afterGetOrderIdByTransactionId(
        \Mollie\Payment\Model\Mollie $subject,
        $result,
        string $transactionId
    ) {
        try {
            $mollieOrder = $this->mollieOrderRepository->getByTransactionId($transactionId);
            return $mollieOrder->getOrderId();
        } catch (NoSuchEntityException $e) {
            return false;
        }
    }

}
