<?php

namespace App\Controllers;
use App\Models\Job;
use Respect\Validation\Validator as v;

class JobController extends BaseController{
        public function getAddJobAction($request) {
            $responseMessage =null;
            if($request->getMethod() == 'POST'){
                $postData = $request->getParsedBody();
                $jobValidator = v::key('title', v::stringType()->notEmpty())
                    ->key('description', v::stringType()->notEmpty());
            
                try {
                    $jobValidator->assert($postData);
                    $postData = $request->getParsedBody();

                    $files= $request->getUploadedFiles();
                    $logo = $files['logo'];
                    $dirFileName = "uploads/none.jpg";
                    

                    if ($logo->getError() == UPLOAD_ERR_OK) {
                        $fileName = $logo->getClientFileName();
                        $dirFileName = "uploads/" .$fileName;
                        $logo->moveTo($dirFileName);
                    }

                    $job = new Job();
                    $job->title = $postData['title'];
                    $job->description = $postData['description'];
                    $job->fileName = $dirFileName;
                    $job->save();
                    $responseMessage = 'Saved';
                } catch (\Exception $e) {
                    $responseMessage = $e->getmessage();
                };
            }
            return $this->renderHTML('addJob.twig',[
                'responseMessage' => $responseMessage
            ]);
        }
    }