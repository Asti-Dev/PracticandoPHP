<?php

namespace App\Controllers;
use App\Models\Project;
use Respect\Validation\Validator as v;

    class ProjectController extends BaseController {
        public function getAddProjectAction($request) {
            $responseMessage =null;
            if($request->getMethod() == 'POST'){
                $postData = $request->getParsedBody();
                $projectValidator = v::key('title', v::stringType()->notEmpty())
                    ->key('description', v::stringType()->notEmpty());
                try {
                    $projectValidator->assert($postData);
                    $proyect = new Project();
                    $proyect->title = $postData['title'];
                    $proyect->description = $postData['description'];
                    $proyect->save();
                    $responseMessage = 'Saved';
                } catch (\Exception $e) {
                    $responseMessage = $e->getmessage();
                };
            }

            return $this->renderHTML('addProject.twig',[
                'responseMessage' => $responseMessage
            ]);
        }
    }