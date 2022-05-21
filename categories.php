<?php
    function getCat($mysqli){
        $sql = 'SELECT * FROM `category`';
        $res = $mysqli->query($sql);

        //Создаем масив где ключ массива является ID меню
        $cat = array();
        while($row = $res->fetch()){
            $cat[$row['id']] = $row;
        }
        return $cat;
    }

    //Функция построения дерева из массива от Tommy Lacroix
    function getTree($dataset) {
        $tree = array();

        foreach ($dataset as $id => &$node) {
            //Если нет вложений
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                //Если есть потомки то перебераем массив
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    function showCat($data){
        $string = '';
        foreach($data as $item){
            $string .= tplMenu($item);
        }
        return $string;
    }
    //Шаблон для вывода меню в виде дерева
    function tplMenu($category){
        $menu = '<li class="list-group-item">
            <a href="index.php?page=main&id='. $category['id'] .'">'.
            $category['name'].'</a>';

        if(isset($category['childs'])){
            $menu .= '<ul class="list-group">'. showCat($category['childs']) .'</ul>';
        }
        $menu .= '</li>';

        return $menu;
    }
?>

<div style="display: flex; margin-top: 80px">
    <div style="width: 20%">
        <h1>Категории</h1>
        <?php
            $cat  = getCat($conn);
            $tree = getTree($cat);
            $cat_menu = showCat($tree);
            echo '<ul class="list-group">'. $cat_menu .'</ul>';
        ?>
    </div>

