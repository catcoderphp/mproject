<?php


namespace App\Model;


use Zend\Http\Response;

class ResponseHandler
{
    public $error;
    public $data;
    public $statusCode;
    public $message;
    public $meta;

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta): void
    {
        $this->meta = $meta;
    }

    public function notFound(): ResponseHandler
    {
        $this->setStatusCode(Response::STATUS_CODE_404);
        $this->setData([]);
        $this->setError(true);
        $this->setMessage("Not Found");
        $this->buildMeta(0,0,0);
        return $this;
    }

    public function buildMeta($totalItems,$currentPage,$totalPages)
    {
        $this->setMeta( [
            "total_items" => $totalItems,
            "current_page" => $currentPage,
            "total_pages" => $totalPages
        ]);
    }


}