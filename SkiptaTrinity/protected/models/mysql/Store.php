<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Store extends CActiveRecord {

    public $Id;
    public $DescriptiveName;
    public $Address1;
    public $Address2;
    public $City;
    public $State;
    public $PostalCode;
    public $Division;
    public $Region;
    public $District;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Store';
    }
    /**
     * @author Sagar Pathapelli
     * @param type $storeId
     * @return districtId (int) 
     */
    public function getDistrictByStore($storeId) {
        $result = 'failure';
        try {
            $query = "SELECT District FROM Store  where Id=$storeId";
            $store = Yii::app()->db->createCommand($query)->queryRow();
            if($store['District']){
                $result=(int)$store['District'];
            }
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getDistrictByStore==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
    /**
     * @author Sagar Pathapelli
     * @param type $districtId
     * @return stores (array)
     */
    public function getStoresByDistrict($districtId) {
        $result = 'failure';
        try {
            $query = "SELECT Id FROM Store  where District=$districtId";
            $res = Yii::app()->db->createCommand($query)->queryAll();
            $stores=array();
            foreach ($res as $row) {
                array_push($stores, (int)$row['Id']);
            }
            $result = $stores;
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getStoresByDistrict==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
    /**
     * @author Sagar Pathapelli
     * @param type $storeId
     * @return regionId (int) 
     */
    public function getRegionByStore($storeId) {
        $result = 'failure';
        try {
            $query = "SELECT Region FROM Store  where Id=$storeId";
            $store = Yii::app()->db->createCommand($query)->queryRow();
            if($store['Region']){
                $result=(int)$store['Region'];
            }
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getRegionByStore==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
    /**
     * @author Sagar Pathapelli
     * @param type $regionId
     * @return stores (array)
     */
    public function getStoresByRegion($regionId) {
        $result = 'failure';
        try {
            $query = "SELECT Id FROM Store  where Region=$regionId";
            $res = Yii::app()->db->createCommand($query)->queryAll();
            $stores=array();
            foreach ($res as $row) {
                array_push($stores, (int)$row['Id']);
            }
            $result = $stores;
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getStoresByRegion==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
    /**
     * @author Sagar Pathapelli
     * @param type $storeId
     * @return divisionId (int) 
     */
    public function getDivisionByStore($storeId) {
        $result = 'failure';
        try {
            $query = "SELECT Division FROM Store  where Id=$storeId";
            $store = Yii::app()->db->createCommand($query)->queryRow();
            if($store['Division']){
                $result=(int)$store['Division'];
            }
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getDivisionByStore==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
    /**
     * @author Sagar Pathapelli
     * @param type $divisionId
     * @return stores (array)
     */
    public function getStoresByDivision($divisionId) {
        $result = 'failure';
        try {
            $query = "SELECT Id FROM Store  where Division=$divisionId";
            $res = Yii::app()->db->createCommand($query)->queryAll();
            $stores=array();
            foreach ($res as $row) {
                array_push($stores, (int)$row['Id']);
            }
            $result = $stores;
            return $result;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getStoresByDivision==" . $exc->getMessage(), "error", "application");
            return "exception";
        }
    }
}
