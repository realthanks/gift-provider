<?php
namespace WiserBrand\RealThanks\Ui\Component\Gift\Listing\Action;

use Magento\Ui\Component\Listing\Columns\Column;

class SendGift extends Column
{
    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            $item[$this->getData('name')]['details'] = [
                'callback' => [
                    [
                        'provider' => 'rt_gift_grid_list.rt_gift_grid_list.modalContainer'
                            . '.send_gift_modal.send_gift_form_loader',
                        'target' => 'destroyInserted',
                    ],
                    [
                        'provider' => 'rt_gift_grid_list.rt_gift_grid_list.modalContainer'
                            . '.send_gift_modal.send_gift_form_loader',
                        'target' => 'updateData',
                        'params' => [
                            'gift_id' => $item['entity_id']
                        ]
                    ],
                    [
                        'provider' => 'rt_gift_grid_list.rt_gift_grid_list.modalContainer.send_gift_modal',
                        'target' => 'openModal'
                    ]
                ],
                'href' => '#',
                'label' => __('Send gift'),
            ];
        }

        return $dataSource;
    }
}
