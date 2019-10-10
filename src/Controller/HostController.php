<?php

namespace App\Controller;


use App\Entity\Host;
use App\Form\Type\HostType;
use App\Manager\CertificateManager;
use Enhavo\Bundle\AppBundle\Controller\AbstractViewController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HostController extends AbstractViewController
{
    /**
     * @var CertificateManager
     */
    private $certificateManager;

    /**
     * HostController constructor.
     */
    public function __construct(CertificateManager $certificateManager)
    {
        $this->certificateManager = $certificateManager;
    }

    /**
     * @param Request $request
     */
    public function renewcertificateAction(Request $request)
    {
        $id = $request->get('id');

        $repo = $this->getDoctrine()->getRepository(Host::class);
        $host = $repo->find($id);

        if (!$host) {
            throw $this->createNotFoundException();
        }

        $success = $this->certificateManager->renewCertificate($host);
        if ($success) {
            $serializer = $this->get('serializer');
            $json = $serializer->normalize($host, null, ['groups' => ['certificate']]);
            return new JsonResponse($json);
        }

        return new JsonResponse([], 400);
    }
}
