<?php

namespace AppBundle\Controller;

use Google\Cloud\Translate\TranslateClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TranslateController extends Controller
{
    /**
     * @Route("/translate/{sourceLanguage}/{targetLanguage}")
     * @Method({"GET", "POST"})
     */
    public function translateAction(Request $request, $sourceLanguage, $targetLanguage)
    {
        $input = $request->getMethod() === 'POST' ? $request->getContent() : $request->query->get('input');

        try {
            $translate = new TranslateClient();
            $result = $translate->translate($input, [
                'source' => $sourceLanguage,
                'target' => $targetLanguage,
                'model' => NULL,
            ]);

            $result += [
                'source' => $sourceLanguage,
                'target' => $targetLanguage,
            ];

            return new JsonResponse($result);
        } catch (\Throwable $t) {
            $result = json_decode($t->getMessage()) ?: $t->getMessage();

            return new JsonResponse($result);
        }
    }
}
