<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MessageModel;
use App\Models\AccountModel;

class ChatController extends ResourceController
{
    use ResponseTrait;

    protected $messageModel;
    protected $accountModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->accountModel = new AccountModel();
    }

    public function index()
    {
        // Your default action logic goes here
    }

    public function getMessages()
    {
        try {
            // Get the receiver ID from the query parameters
            $receiverId = $this->request->getGet('receiverId');

            // Fetch messages where the current user is the sender or receiver
            $messages = $this->messageModel
                ->where('sender', $this->getCurrentUserID())
                ->orWhere('receiver', $this->getCurrentUserID())
                ->orWhere('receiver', $receiverId)
                ->orWhere('sender', $receiverId)
                ->findAll();

            return $this->respond($messages);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching messages');
        }
    }

    public function sendMessage()
    {
        try {
            $data = $this->request->getJSON(true);

            // Validate the input data, you may add validation rules here

            // Save the new message
            $data['sender'] = $this->getCurrentUserID();
            $this->messageModel->insert($data);

            // You may want to handle additional logic here, such as sending notifications

            return $this->respondCreated(['message' => 'Message sent successfully']);
        } catch (\Exception $e) {
            return $this->failServerError('Error sending message');
        }
    }

    // Helper function to get the current user ID
    protected function getCurrentUserID()
    {
        // Adjust this based on how you pass or retrieve the user ID in your application
        return /* logic to get the user ID */;
    }
}
