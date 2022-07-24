<?php

namespace App\Utils;

use App\Service\DataProviderService;
use Symfony\Contracts\Service\Attribute\Required;

trait DataStringAwareTrait
{
    private string $data;

    #[Required]
    public function setData(DataProviderService $dataProviderService): void
    {
        $this->data = $dataProviderService->getData();
    }
}