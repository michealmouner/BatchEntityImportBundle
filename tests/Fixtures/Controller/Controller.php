<?php

declare(strict_types=1);

namespace JG\BatchEntityImportBundle\Tests\Fixtures\Controller;

use Doctrine\ORM\EntityManagerInterface;
use JG\BatchEntityImportBundle\Controller\ImportControllerTrait;
use JG\BatchEntityImportBundle\Tests\Fixtures\Configuration\TranslatableEntityBaseConfiguration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Controller extends AbstractController
{
    use ImportControllerTrait;

    public function import(Request $request, ValidatorInterface $validator, EntityManagerInterface $em): Response
    {
        return $this->doImport($request, $validator, $em);
    }

    public function importSave(Request $request, TranslatorInterface $translator, EntityManagerInterface $em): Response
    {
        return $this->doImportSave($request, $translator, $em);
    }

    protected function redirectToImport(): RedirectResponse
    {
        return $this->redirectToRoute('jg.batch_entity_import_bundle.test_controller.import');
    }

    protected function getMatrixSaveActionUrl(): string
    {
        return $this->generateUrl('jg.batch_entity_import_bundle.test_controller.import_save');
    }

    protected function getImportConfigurationClassName(): string
    {
        return TranslatableEntityBaseConfiguration::class;
    }
}
