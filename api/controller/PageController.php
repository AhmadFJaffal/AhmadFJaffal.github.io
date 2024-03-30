<?php
require_once PROJECT_ROOT_PATH . "/model/PageModel.php";

class PageController extends baseController
{
    private $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    // List all active pages
    public function listPagesAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $pages = $this->pageModel->getAllPages();

                $responseData = json_encode([
                    'pages' => $pages
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

    // Delete a specific page by its PageID
    public function deletePageAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $pageID = $data['PageID'] ?? null;

            if (!$pageID) {
                $strErrorDesc = 'PageID not provided';
                $strErrorHeader = 'HTTP/1.1 400 Bad Request';
            } else {
                try {
                    $result = $this->pageModel->deletePage($pageID);

                    if ($result) {
                        $responseData = json_encode(['status' => 'success', 'message' => 'Page deleted successfully']);
                    } else {
                        $strErrorDesc = 'Failed to delete the page';
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

    // Add a new page
    public function addPageAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            $title = $_POST['Title'];
            $body = $_POST['Body'];
            $active = ($_POST['Active'] === "true" || $_POST['Active'] === true) ? 1 : 0;  // Transformation
            $priority = $_POST['Priority'];

            try {
                $result = $this->pageModel->addPage($title, $body, $active, $priority);

                if ($result) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Page added successfully']);
                } else {
                    $strErrorDesc = 'Failed to add the page';
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
}
