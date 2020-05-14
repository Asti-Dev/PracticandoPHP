<?php

namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;

    class UserController extends BaseController {
        public function getAddUserAction($request) {
            $responseMessage =null;
            if($request->getMethod() == 'POST'){
                $postData = $request->getParsedBody();
                $userValidator = v::key('username', v::stringType()->notEmpty())
                    ->key('email', v::stringType()->notEmpty())
                    ->key('password', v::stringType()->notEmpty());
                try {
                    $userValidator->assert($postData);
                    $user = new User();
                    $user->username = $postData['username'];
                    $user->email = $postData['email'];
                    $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
                    // var_dump($user);
                    $user->save();
                    $responseMessage = 'Saved';
                } catch (\Exception $e) {
                    $responseMessage = $e->getmessage();
                };
            }

            return $this->renderHTML('addUser.twig',[
                'responseMessage' => $responseMessage
            ]);
        }
    }