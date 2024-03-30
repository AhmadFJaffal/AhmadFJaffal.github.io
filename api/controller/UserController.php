<?php
require_once PROJECT_ROOT_PATH . "/model/UserModel.php";


class UserController extends baseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $intLimit = 10; // default limit
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrEmployees = $this->userModel->getEmployees($intLimit);
                $responseData = json_encode($arrEmployees);
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


    public function loginAction($email, $password)
    {
        if ($this->userModel->checkEmployee($email, $password)) {
            $adminInfo = $this->userModel->getEmpInfo($email);
            return [
                'status' => 'success',
                'userType' => 'employee',
                'EmpID' => $adminInfo['EmpID'],
                'SuperAdmin' => $adminInfo['isSuperAdmin'] ?? false,
                'EmpName' => $adminInfo['EmpName']
            ];
        } elseif ($this->userModel->checkIntern($email, $password)) {
            $internInfo = $this->userModel->getInternInfo($email);

            if ($internInfo) {


                return [
                    'status' => 'success',
                    'userType' => 'interns',
                    'InternID' => $internInfo['InternID'],
                    'FullName' => $internInfo['FullName'],
                    'Email' => $internInfo['Email'],
                    'Mobile' => $internInfo['Mobile'],
                    'GradDate' => $internInfo['GradDate'],
                    'University' => $internInfo['University'],
                    'Major' => $internInfo['Major'],
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Invalid email or password'
                ];
            }
        }
    }
    public function deleteEmpAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $EmpID = $_POST['EmpID'];

                $userModel = new UserModel();
                $success = $userModel->deleteEmpByID($EmpID);

                if ($success) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
                } else {
                    $strErrorDesc = 'Failed to delete the Employee';
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
    public function addEmployeeAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $contentType = 'Content-Type: application/json';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $data = [
                    'fName' => $_POST['fName'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role' => $_POST['role'],
                    'major' => $_POST['major'],
                    'CreationDate' => $_POST['CreationDate']
                ];

                $success = $this->userModel->addEmployee($data);

                if ($success) {
                    $responseData = json_encode(['status' => 'success', 'message' => 'Employee added successfully']);
                } else {
                    $strErrorDesc = 'Failed to add the employee';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage();
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
    public function getEmployeeProgramsAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                // Get the employee ID from the GET request
                $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                $employeeId = end($uriSegments);


                // Fetch assigned programs for the employee using $employeeId
                $assignedPrograms = $this->userModel->getEmployeePrograms($employeeId);

                // Return the assigned programs as JSON
                $responseData = json_encode(['programTitles' => $assignedPrograms]);
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
}
