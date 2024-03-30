<?php
require_once PROJECT_ROOT_PATH . "/model/ProgramModel.php";

class ProgramController extends baseController
{
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $programModel = new ProgramModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrPrograms = $programModel->getPrograms($intLimit);
                $responseData = json_encode($arrPrograms);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 405 Method Not Allowed';
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
    public function getDetailsAction()
    {
        $programID = $_POST['programID'];  // Extracting from POST data

        $programModel = new ProgramModel();
        $programDetails = $programModel->getProgramDetails($programID);

        if ($programDetails) {
            $this->sendOutput(
                json_encode($programDetails),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(['error' => 'Program not found']),
                array('Content-Type: application/json', 'HTTP/1.1 404 Not Found')
            );
        }
    }
    public function deleteProgAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $ProgID = $_POST['ProgID'];

                $ProgramModel = new ProgramModel();
                $success = $ProgramModel->deleteProgByID($ProgID);

                if ($success) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Program deleted successfully']);
                } else {
                    $strErrorDesc = 'Failed to delete the Program';
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
    public function addProgramAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod == 'POST') {
            // Gather all the form data
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'maxCapacity' => $_POST['maxCapacity'],
                'currentCapacity' => $_POST['currentCapacity'],
                'classCode' => $_POST['classCode'],
                'examLink' => $_POST['examLink']
            ];

            $programModel = new ProgramModel();

            try {
                $success = $programModel->addProgram($data);

                if ($success) {
                    $this->sendOutput(
                        json_encode(['success' => 'Program added successfully']),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(
                        json_encode(['error' => 'Failed to add program']),
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
            // handle unsupported method
            $this->sendOutput(
                json_encode(['error' => 'Method not supported']),
                array('Content-Type: application/json', 'HTTP/1.1 405 Method Not Allowed')
            );
        }
    }
    public function assignEmployeeToProgramAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if ($requestMethod == 'POST') {
            $empID = $_POST['empID'];
            $programID = $_POST['programID'];

            $programModel = new ProgramModel();

            try {
                $success = $programModel->assignEmployeeToProgram($empID, $programID);

                if ($success) {
                    $this->sendOutput(
                        json_encode(['success' => 'Employee assigned to program successfully']),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } else {
                    $this->sendOutput(
                        json_encode(['error' => 'Failed to assign employee to program']),
                        array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
                    );
                }
            } catch (Exception $e) {
                $this->sendOutput(
                    json_encode(['error' => $e->getMessage()]),
                    array('Content-Type: application/json', 'HTTP/1.1 400 Bad Request')
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
    public function getEmployeesByProgramAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod == 'GET') {
            $programID = $_GET['programID'];

            $programModel = new ProgramModel();

            try {
                $employees = $programModel->getEmployeesByProgramID($programID);

                // Check if the result is an array (even if empty) 
                if (is_array($employees)) {
                    $this->sendOutput(
                        json_encode($employees),
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
