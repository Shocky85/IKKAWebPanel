<?php

namespace IKKA\DAO;

use IKKA\Domain\Category;

/**
 * Data Access Object for the Category type
 */
class CategoryDAO extends DAO {

    //method to build a Category Object
    protected function buildDomainObject($row) {
        //set attributes of the Object
        $category = new Category();
        $category->setId($row['category_id']);
        $category->setLabel($row['label']);
        //return the final Object
        return $category;
    }

    //method to request all categories on the WeService
    // : GET
    public function findAll() {
        $url = '' . WSIKKACHIEVEMENT . '/categories';
        $result = getDataFromJSON($url);
        $categories = array();
        //if find some results, build obeject
        if ($result != null) {
            foreach ($result as $row) {
                $categoryId = $row['category_id'];
                $categories[$categoryId] = $this->buildDomainObject($row);
            }
        }
        return $categories;
    }

    //find a specific category
    // : GET
    public function find($id) {
        $url = '' . WSIKKACHIEVEMENT . '/categories/' . $id . '';
        $category = getDataFromJSON($url);
        //if result
        if ($category) {
            return $this->buildDomainObject($category);
        } else {
            throw new \Exception("No category matching id " . $id);
        }
    }

}
