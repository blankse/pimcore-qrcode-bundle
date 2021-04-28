<?php

namespace GalDigital\QrCodeBundle\Controller;

use GalDigital\QrCodeBundle\Exception\QrCodeNotFoundException;
use GalDigital\QrCodeBundle\Model\QrCode;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QrCodeController extends FrontendController
{
    public function code(Request $request): Response
    {
        $name = $request->get('name');
        $code = QrCode::getByName($name);

        if (!$code) {
            throw new QrCodeNotFoundException(sprintf('QR code with name "%s" not found', $name));
        }

        return $this->redirect($code->getUrl());
    }
}
