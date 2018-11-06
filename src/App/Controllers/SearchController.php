<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 06.11.18
 * Time: 14:48
 */

namespace App\Controllers;

use App\DataBase\DataBase;
use App\Views\View;

class SearchController extends Controller
{
    public function actionShow($params, $tabel=NULL) {
        if (!$tabel) {
            $tabel = $this->getTabel(true);
        }
        $this->_view = new View($this->_route, 'table');
        $this->_view->render('Поиск', $tabel);
    }

    public function actionGetResult($params) {
        $field = $_POST['field'];
        $value = $_POST['input'];

        $tabel = $this->getTabel(false, $field, $value);

        $this->_view = new View($this->_route, 'table');
        $this->_view->render('Результат фильтрации', $tabel);
    }

    private function getTabel($select_all, $field = '', $value = '') {
        $db = new DataBase();
        $values = [];
        $action = 'select_all';
        if (!$select_all) {
            $fields = [
                'ID' => 'id',
                'Логин' => 'login',
                'Почта' => 'email',
                'День рождения' => 'birthday',
            ];
            $values[$fields[$field]] = $value;
            $action = 'find';
        }
        return $result_of_query = $db->query(
            $action,
            'Users',
            $values
        );
    }
}