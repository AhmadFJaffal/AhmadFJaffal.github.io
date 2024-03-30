<?php
require_once PROJECT_ROOT_PATH . "/model/LookupModel.php";

class LookupController extends baseController
{
    private $lookupModel;

    public function __construct()
    {
        $this->lookupModel = new LookupModel();
    }
    public function listLookupsAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $lookupInfos = $this->lookupModel->getAllLookupInfos();
                $lookupItems = $this->lookupModel->getAllLookupItems();

                $responseData = json_encode([
                    'lookupInfos' => $lookupInfos,
                    'lookupItems' => $lookupItems
                ]);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array($contentType, $strErrorHeader)
            );
        }
    }
    public function addLookupAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $name = $_POST['name'];
                $employeeID = $_POST['employeeID'];

                $result = $this->lookupModel->addLookupInfo($name, $employeeID);

                if ($result) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Lookup Info added successfully']);
                } else {
                    $strErrorDesc = 'Failed to add the Lookup Info';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array($contentType, $strErrorHeader)
            );
        }
    }

    public function addLookupItemAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $name = $_POST['name'];
                $parentID = $_POST['parentID'];
                $priority = $_POST['priority'];
                $result = $this->lookupModel->addLookupItem($name, $parentID, $priority);
                if ($result) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Lookup Item added successfully']);
                } else {
                    $strErrorDesc = 'Failed to add the Lookup Item';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array($contentType, $strErrorHeader)
            );
        }
    }

    public function deleteLookupAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            // Fetch the raw POST data and decode it
            $data = json_decode(file_get_contents("php://input"), true);
            $infoCode = $data['infoCode'] ?? null; // Fetch the infoCode from the request body

            if (!$infoCode) {
                $strErrorDesc = 'infoCode not provided';
                $strErrorHeader = 'HTTP/1.1 400 Bad Request';
            } else {
                try {
                    $result = $this->lookupModel->deleteLookupInfo($infoCode);

                    if ($result) {
                        $responseData = json_encode(['status' => 'success', 'message' => 'Lookup Info deleted successfully']);
                    } else {
                        $strErrorDesc = 'Failed to delete the Lookup Info';
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    }
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array($contentType, $strErrorHeader)
            );
        }
    }
    public function deleteLookupItemAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            // Fetch the raw POST data and decode it
            $data = json_decode(file_get_contents("php://input"), true);
            $itemCode = $data['ItemCode'] ?? null; // Fetch the itemCode from the request body

            if (!$itemCode) {
                $strErrorDesc = 'itemCode not provided';
                $strErrorHeader = 'HTTP/1.1 400 Bad Request';
            } else {
                try {
                    // Delete the item using the deleteLookupItem method
                    $result = $this->lookupModel->deleteLookupItem($itemCode);

                    if ($result) {
                        $responseData = json_encode(['status' => 'success', 'message' => 'Lookup Item deleted successfully']);
                    } else {
                        $strErrorDesc = 'Failed to delete the Lookup Item';
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    }
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array($contentType, 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array($contentType, $strErrorHeader)
            );
        }
    }
}
