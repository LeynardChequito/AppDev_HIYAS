<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\GroupMessageModel;
use App\Models\AccountModel;
use App\Models\SectionModel;

class GroupChatController extends ResourceController
{
    use ResponseTrait;

    protected $groupMessageModel;
    protected $accountModel;

    public function __construct()
    {
        $this->groupMessageModel = new GroupMessageModel();
        $this->accountModel = new AccountModel();
        $this->sectionModel = new SectionModel();
    }

    public function getGroupMessages($groupId)
    {
        try {
            // Get the currently logged-in user ID
            $loggedUserId = $this->getUserIdFromToken();

            if (!$loggedUserId) {
                return $this->failUnauthorized('Invalid token or user not logged in.');
            }

            // Fetch section of the logged-in user
            $loggedUser = $this->accountModel->find($loggedUserId);
            $loggedUserSection = $loggedUser['section'];

            //getuser firstname and lastname then match with the student firstname and lastname then saka ichecheck ang section tapos pag nacheck ang section saka ilalagay sa receiver tapos un na un siguro

            // Fetch group messages where sender is in the same section or the receiver is the logged-in user's section
            $messages = $this->groupMessageModel
                ->where('sender', $loggedUserSection)
                ->orWhere('receiver', $loggedUserSection)
                ->findAll();

            // Fetch sender and receiver names from the account table
            foreach ($messages as &$message) {
                $sender = $this->accountModel->find($message['sender']);
                $receiver = $this->sectionModel->find($message['receiver']);
                $message['sender_name'] = $sender['firstname'];
                $message['receiver_name'] = $receiver['firstname'];
            }

            return $this->respond($messages, 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching group messages');
        }
    }



    public function sendMessage()
    {
        try {
            // Get the data from the request
            $data = $this->request->getJSON(true);

            // Get the currently logged-in user (assuming you have authentication implemented)
            $loggedUserId = $this->getUserIdFromToken();

            // Validate the data if necessary

            // Fetch sender name from the account table
            $sender = $this->accountModel->find($loggedUserId);

            if (!$sender) {
                return $this->failValidationError('Invalid sender');
            }

            // Set sender information in the $data array
            $data['sender'] = $sender['id'];

            // Add the group chat message to the database
            $this->groupMessageModel->insert($data);

            return $this->respondCreated(['status' => 'Group message sent successfully']);
        } catch (\Exception $e) {
            return $this->failServerError('Error sending group message');
        }
    }


    // Add the following method to your controller to get the user ID from the token
    private function getUserIdFromToken()
    {
        $request = service('request');
        $key = getenv('JWT_SECRET');
        $headers = $request->getHeader('authorization');
        $token = $headers->getValue();

        try {
            // Decode the token and extract user data
            $decodedToken = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\KEY($key, 'HS256'));
            return $decodedToken->id;
        } catch (\Exception $e) {
            // Handle token decoding errors
            return null;
        }
    }
}
