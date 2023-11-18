<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MessageModel;
use App\Models\AccountModel;

use Firebase\JWT\JWT;
use Firebase\JWT\KEY;

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
    }

    public function getMessages()
    {
        try {
            // Get the currently logged-in user ID
            $loggedUserId = $this->getUserIdFromToken();

            if (!$loggedUserId) {
                return $this->failUnauthorized('Invalid token or user not logged in.');
            }

            // Fetch messages from the database where the user is either sender or receiver
            $messages = $this->messageModel
                ->where('sender', $loggedUserId)
                ->orWhere('receiver', $loggedUserId)
                ->findAll();

            // Fetch sender and receiver names from the account table
            foreach ($messages as &$message) {
                $sender = $this->accountModel->find($message['sender']);
                $receiver = $this->accountModel->find($message['receiver']);
                $message['sender_name'] = $sender['firstname'];
                $message['receiver_name'] = $receiver['firstname'];
            }

            return $this->respond($messages, 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching messages');
        }
    }

    public function sendMessage()
    {
        try {
            // Get the data from the request
            $data = $this->request->getJSON(true);

            // Check if "receiver" key exists in the $data array
            if (!isset($data['receiver'])) {
                return $this->failValidationError('Receiver is required.');
            }

            // Get the currently logged-in user (assuming you have authentication implemented)
            $loggedUserId = $this->getUserIdFromToken();

            // Validate the data if necessary

            // Fetch sender name from the account table
            $sender = $this->accountModel->find($loggedUserId);

            // Fetch receiver name from the account table
            $receiver = $this->accountModel->find($data['receiver']);

            if (!$sender || !$receiver) {
                return $this->failValidationError('Invalid sender or receiver');
            }

            // Set sender and receiver information in the $data array
            $data['sender'] = $sender['id'];
            $data['receiver'] = $receiver['id'];

            // Add the message to the database
            $this->messageModel->insert($data);

            return $this->respondCreated(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            return $this->failServerError('Error sending message');
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
            $decodedToken = JWT::decode($token, new KEY($key, 'HS256'));
            return $decodedToken->id;
        } catch (\Exception $e) {
            // Handle token decoding errors
            return null;
        }
    }

    public function getConnectedUsers()
    {
        try {
            // Get the currently logged-in user ID
            $loggedUserId = $this->getUserIdFromToken();

            if (!$loggedUserId) {
                return $this->failUnauthorized('Invalid token or user not logged in.');
            }

            // Fetch connected users from the database (adjust the logic based on your requirements)
            $connectedUsers = $this->messageModel
                ->distinct()
                ->select('sender, receiver')
                ->where('sender', $loggedUserId)
                ->orWhere('receiver', $loggedUserId)
                ->findAll();

            // Merge sender and receiver IDs, then remove the current user's ID
            $userIds = array_merge(array_column($connectedUsers, 'sender'), array_column($connectedUsers, 'receiver'));
            $userIds = array_diff($userIds, [$loggedUserId]);

            // Fetch unique user IDs
            $uniqueUserIds = array_unique($userIds);

            // Fetch user details from the account table based on unique user IDs
            $uniqueUsers = $this->accountModel->find($uniqueUserIds);

            // Prepare the response data with the latest message for each user
            $responseData = [];
            foreach ($uniqueUsers as $user) {
                // Get the latest message for the current user as either sender or receiver
                $latestMessage = $this->messageModel
                    ->where('receiver', $loggedUserId)
                    ->where('sender', $user['id'])
                    ->orWhere('receiver', $user['id'])
                    ->orderBy('id', 'desc')
                    ->first();

                $responseData[] = [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'mobile_or_email' => $user['mobile_or_email'],
                    'latest_message' => $latestMessage ? $latestMessage['message'] : null,
                    'when' => $latestMessage ? $latestMessage['created_at'] : null,
                ];
            }

            return $this->respond(['users' => $responseData], 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching connected users');
        }
    }


    // Add this method to your ChatController
    public function getUserMessages($userId)
    {
        try {
            // Get the currently logged-in user ID
            $loggedUserId = $this->getUserIdFromToken();

            if (!$loggedUserId) {
                return $this->failUnauthorized('Invalid token or user not logged in.');
            }

            // Fetch messages from the database where the user is either sender or receiver
            $messages = $this->messageModel
                ->whereIn('sender', [$loggedUserId, $userId])
                ->whereIn('receiver', [$loggedUserId, $userId])
                ->orderBy('created_at', 'asc')
                ->findAll();

            // Fetch sender and receiver names from the account table
            foreach ($messages as &$message) {
                $sender = $this->accountModel->find($message['sender']);
                $receiver = $this->accountModel->find($message['receiver']);
                $message['sender_name'] = $sender['firstname'];
                $message['receiver_name'] = $receiver['firstname'];
            }

            return $this->respond($messages, 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching user messages');
        }
    }
}
