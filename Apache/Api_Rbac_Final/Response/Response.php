<?php

    class Response {
        
        public function ResMessage($Status = 'Null', $Result = ["Empty"], $Code = 200) {
            $response = array(
            'Status' => $Status,
            'message' => $Result,
            "StatusCode" => $Code
            );
            http_response_code($Code);
            echo json_encode($response);
        }

        public function ConnectSuccess($Status = false,$code = 200) {
            $response = array(
                'ConnectSuccess' => $Status,
                "StatusCode" => $code
            );
                http_response_code($code);
                echo json_encode($response);
        }

        public function Message($Result = ["Empty"], $Code = 200) {
            $response = array(
                'Status' => $Result,
                "StatusCode" => $Code
            );
                http_response_code($Code);
                echo json_encode($response);
        }

        public function MessageError($Result = ["Empty"], $Code = 404) {
            $response = array(
                'Status' => $Result,
                "StatusCode" => $Code
            );
                http_response_code($Code);
                echo json_encode($response);
        }

        public function getDataUser($User = false,$code = 200) {
            $response = array(
                'User' => $User,
                "StatusCode" => $code
            );
                http_response_code($code);
                echo json_encode($response);
        }

        public function getDataContent($count, $data = ["Empty"], $code = 404) {
            $response = array(
                'Index' => $count,
                'Data' => $data,
                "StatusCode" => $code
            );
                http_response_code($code);
                echo json_encode($response);
        }

        public function getData($count, $data = ["Empty"], $code = 404) {
            $response = array(
                'Index' => $count,
                'Data' => $data,
                "StatusCode" => $code
            );
                http_response_code($code);
                echo json_encode($response);
        }

        public function getDateContentDetail($inex, $Result = ["Empty"], $Code = 404) {
            $response = array(
                'Index' => $inex,
                'Data' => $Result,
                "StatusCode" => $Code
            );
                http_response_code($Code);
                echo json_encode($response);
        }

    }

?>