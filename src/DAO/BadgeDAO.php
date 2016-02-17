<?php

namespace IKKA\DAO;

use IKKA\Domain\Badge;

/**
 * Data Access Object for the Badge type
 */
class BadgeDAO extends DAO {

    //method to build a Badge Object
    protected function buildDomainObject($row) {
        $badge = new Badge();
        //set attributes of the Object
        $badge->setId($row['badge_id']);
        $badge->setTitle($row['title']);
        $badge->setIdCategorie($row['category_id']);
        $badge->setDescription($row['description']);
        $badge->setParameters($row['parameters']);
        $badge->setImageUrl($row['urlImage']);
        $badge->setClass($row['category_id']);
        //return the final Object
        return $badge;
    }

//method to request all badges on the WeService 
//: GET
    public function findAll($app) {
        $result = requestWSAuthGet(WSIKKACHIEVEMENT, '/badges', $app);
        $badges = array();
        //if find result we build Final Object
        if ($result != null) {
            foreach ($result as $row) {
                $badgeId = $row['badge_id'];
                $badges[$badgeId] = $this->buildDomainObject($row);
            }
        }
        return $badges;
    }

    /*
      //method to find a specific Badge
      //: GET
      public function find($id) {
      $url = '' . WSIKKACHIEVEMENT . '/badges/' . $id . '';
      $badge = getDataFromJSON($url);
      //if find result we build Final Object
      if ($badge) {
      return $this->buildDomainObject($badge);
      } else {
      throw new \Exception("No badge matching id " . $id);
      }
      } */

    //method to return all badges of one specific category
    //: GET
    public function findAllByCateg($idCategory, $app) {
        $result = requestWSAuthGet(WSIKKACHIEVEMENT, '/badges/categories/' . $idCategory, $app);
        $badges = array();
        //if find result we build Final Object
        if ($result != null) {
            foreach ($result as $row) {
                $badgeId = $row['badge_id'];
                $badges[$badgeId] = $this->buildDomainObject($row);
            }
        }
        return $badges;
    }

    //return all badges of one User and set some attributs like status ans remaining objectif of badge 
    //: GET
    public function findAllByUser($uuid, $app) {
        $result = requestWSAuthGet(WSIKKACHIEVEMENT, '/badges/user/' . $uuid, $app);
        $badges = array();
        //if find result we build Final Object
        if ($result != null) {
            foreach ($result as $row) {
                $badgeId = $row['badge_id'];
                $badges[$badgeId] = $this->buildDomainObject($row);
                $badges[$badgeId]->setStatus($row['status']);
                $badges[$badgeId]->setRemaining($row['remaining']);
            }
        }

        return $badges;
    }

    //method used on the validation of the badge Form 
    //: POST
    public function create() {
        $badgeData = json_encode(array(
            'title' => $_POST['badge']['title'],
            'description' => $_POST['badge']['description'],
            'category_id' => (int) $_POST['badge']['category'],
            'parameters' => $_POST['badge']['parameters'],
            'urlImage' => $_POST['badge']['image_url'],
        ));
        $result = requestWS(WSIKKACHIEVEMENT, "/badges", "POST", $badgeData);
    }

}
