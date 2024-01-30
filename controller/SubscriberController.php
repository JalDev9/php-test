<?php
require_once __DIR__ . '/../model/SubscriberModel.php';

class SubscriberController
{
    private $model;

    public function __construct(SubscriberModel $model)
    {
        $this->model = $model;
    }

    public function handlePostRequest($data)
    {
        $result = $this->model->writeSubscriber(
            $data['email'],
            $data['name'],
            $data['lastName'],
            $data['status']
        );

        header('Content-Type: application/json');
        echo $result;
    }

    public function handleGetRequest($page, $pageSize)
    {
        $result = $this->model->getAllSubscribers($page, $pageSize);

        header('Content-Type: application/json');
        echo $result;
    }
}
