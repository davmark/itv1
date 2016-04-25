<?php
namespace api\components;

use Yii;
use yii\web\Response;

class ApiResponse extends Response
{
    public $statusResponseCode;
    public $statusResponseMessage;
    public $statusResponseExtra;

    /**
     * Set response code and extra from code.
     *
     * Response extra will be filled based on $extraData value
     * If $extraData is null, response extra will be value from
     * ApiResponseCode::responseExtraFromCode($code)
     * If $extraData is string, response extra will be filled with this value
     */
    public function fillStatusResponse($code, $extraData = null)
    {
        $responseExtra = ApiResponseCode::responseExtraFromCode($code);
        $responseMessage = ApiResponseCode::responseMessageFromCode($code);
        if ($extraData == null) {
            $statusResponseExtra = $responseExtra;
        } else {
            $statusResponseExtra = $extraData;
        }
        $this->statusResponseCode = $code;
        $this->statusResponseMessage = $responseMessage;
        $this->statusResponseExtra = $statusResponseExtra;
    }

    /**
     * Override send() method.
     *
     * $this->data member contains data released to client.
     */
    public function send()
    {
        $responseMessage = ApiResponseCode::responseMessageFromCode($this->statusResponseCode);
        if ($this->isClientError) {
            $dataOut = $this->data;
            if ($this->statusCode == 401) { // Not authorized
                $dataOut = null;
                $this->fillStatusResponse(ApiResponseCode::ERR_LOGIN_REQUIRED);
            } else if ($this->statusCode == 404) { // Non found
                $dataOut = null;
                $this->fillStatusResponse(ApiResponseCode::ERR_METHOD_NOT_FOUND);
            }
            $this->data = [
                'status' => [
                    'response_code' => $this->statusResponseCode,
                    'response_message' => $this->statusResponseMessage,
                    'response_extra' => $this->statusResponseExtra
                ],
                'data' => $dataOut
            ];
        } else {
            $this->data = [
                'status' => [
                    'response_code' => $this->statusResponseCode,
                    'response_message' => $responseMessage,
                    'response_extra' => $this->statusResponseExtra
                ],
                'data' => $this->data
            ];
        }
        parent::send();
    }

    public function init()
    {
        parent::init();
        $this->statusResponseCode = ApiResponseCode::ERR_OK;
    }
}

