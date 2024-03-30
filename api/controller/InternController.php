<?php
require_once PROJECT_ROOT_PATH . "/model/InternModel.php";

class InternController extends baseController
{
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $internModel = new InternModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrInterns = $internModel->getInterns($intLimit);
                $responseData = json_encode($arrInterns);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function addAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $gradDate = DateTime::createFromFormat('Y-m-d', $_POST['GradDate']);
        $today = new DateTime();

        if ($gradDate <= $today) {
            // Handle the error. For instance, by returning an error response.
            $response = ["error" => "The graduation date must be in the future!"];
            echo json_encode($response);
            exit; // Prevents the rest of the code from running
        }
        if ($requestMethod == 'POST') {
            // Gather all the form data
            $data = [
                'fName' => $_POST['fName'],
                'password' => $_POST['password'],
                'GradDate' => $_POST['GradDate'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                'university' => $_POST['university'],
                'major' => $_POST['major']
            ];

            // Handling the CV file upload
            if (isset($_FILES['cvUpload']) && $_FILES['cvUpload']['error'] == 0) {
                $data['CV'] = file_get_contents($_FILES['cvUpload']['tmp_name']);
            }

            $internModel = new InternModel();

            try {
                $success = $internModel->addIntern($data);

                if ($success) {
                    $this->sendOutput(
                        json_encode(['success' => 'Intern added successfully']),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(
                        json_encode(['error' => 'Failed to add intern']),
                        array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Exception $e) {
                $this->sendOutput(
                    json_encode(['error' => $e->getMessage()]),  // Use the exception's message
                    array('Content-Type: application/json', 'HTTP/1.1 400 Bad Request')
                );
            }
        } else {
            
            $this->sendOutput(
                json_encode(['error' => 'Method not supported']),
                array('Content-Type: application/json', 'HTTP/1.1 405 Method Not Allowed')
            );
        }
    }
    
    public function ProgRegAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $status = '';
        $message = '';
        $httpStatusCode = '';
        $contentType = 'Content-Type: application/json';

        if ($requestMethod == 'POST') {
            $internID = $_POST['InternID'];
            $programID = $_POST['programID'];

            $internModel = new InternModel();

            if ($internModel->ProgRegStatus($internID, $programID)) {
                $status = 'already_registered';
                $message = 'You are already registered for this program';
                $httpStatusCode = 'HTTP/1.1 200 OK';
            } else {
                $success = $internModel->InternProgReg($internID, $programID);

                if ($success) {
                    $status = 'success';
                    $message = 'Successfully registered for the program!';
                    $httpStatusCode = 'HTTP/1.1 200 OK';
                } else {
                    $status = 'error';
                    $message = 'Failed to register for the program. Please try again later.';
                    $httpStatusCode = 'HTTP/1.1 500 Internal Server Error';
                }
            }
        } else {
            $status = 'error';
            $message = 'Method not supported';
            $httpStatusCode = 'HTTP/1.1 405 Method Not Allowed';
        }

        $this->sendOutput(
            json_encode(['status' => $status, 'message' => $message]),
            [$contentType, $httpStatusCode]
        );
    }


    public function programAssociationsAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'POST') {   // Check for POST instead of GET
            try {
                

                $internModel = new InternModel();
                $associations = $internModel->getInternProgramAssociations();
                $responseData = json_encode($associations);
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
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function deleteInternAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $internID = $_POST['InternID'];

                $internModel = new InternModel();
                $success = $internModel->deleteInternByID($internID);

                if ($success) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Intern deleted successfully']);
                } else {
                    $strErrorDesc = 'Failed to delete the intern';
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
    public function getInternsByProgramAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod == 'GET') {
            $programID = $_GET['programID'];

            $internModel = new InternModel();

            try {
                $interns = $internModel->getInternsByProgramID($programID);

                
                if (is_array($interns)) {
                    $this->sendOutput(
                        json_encode($interns),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    // Handle unexpected results
                    $this->sendOutput(
                        json_encode(['error' => 'Unexpected result']),
                        array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Exception $e) {
                $this->sendOutput(
                    json_encode(['error' => $e->getMessage()]),
                    array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
                );
            }
        } else {
            // handle unsupported method
            $this->sendOutput(
                json_encode(['error' => 'Method not supported']),
                array('Content-Type: application/json', 'HTTP/1.1 405 Method Not Allowed')
            );
        }
    }
}
