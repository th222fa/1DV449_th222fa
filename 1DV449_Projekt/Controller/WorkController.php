<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 2014-12-16
 * Time: 08:15
 */

require_once("../Models/WorkService.php");
require_once("../Models/Repositories/WorkRepository.php");
require_once("../Models/WebServices/arbetsformedlingenWebService/ArbetsformedlingenWebService.php");

new WorkController();

class WorkController {
    private $workService;

    public function __construct(){

        $this->workService = new WorkService(new WorkRepository(), new ArbetsformedlingenWebService());
        $mode = $this->fetch('mode');
        switch($mode){
            case 'getProvinces':
              echo json_encode($this->workService->getProvinces());
                break;
            case 'getCounties':
               echo json_encode($this->workService->getCounties($this->fetch('provinceId')));
                break;
            case 'getOccupationAreas':

                echo json_encode($this->workService->getOccupationAreas());
                break;
            case 'getJobs':
                echo json_encode($this->workService->getJobs($this->fetch('countyId'), $this->fetch('occupationAreaId')));
                break;
        }
    }

    /**
     * @param $name string
     * @return mixed
     */
    private function fetch($name){
        $val = isset($_POST[$name]) ? $_POST[$name] : 0;
        return ($val);
    }
} 