<?php

namespace asdfstudio\admin\controllers;

use asdfstudio\admin\base\Entity;
use asdfstudio\admin\Module;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\Controller as WebController;

/**
 * Class Controller
 * @package asdfstudio\admin\controllers
 * @property Module $module
 */
abstract class Controller extends WebController {

    public $layout = 'main';

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->view->params['breadcrumbs'][] = [
                'label' => \Yii::t('admin', 'Dashboard'),
                'url' => ['/admin/admin/index'],
            ];
            return true;
        }
        return false;
    }

    /**
     * Load registered item
     * @param string $entity Entity name
     * @return Entity
     */
    public function getEntity($entity) {
        if (isset($this->module->entities[$entity])) {
            return $this->module->entities[$entity];
        } elseif (isset($this->module->entitiesClasses[$entity])) {
            return $this->getEntity($this->module->entitiesClasses[$entity]);
        }
        return null;
    }

}
