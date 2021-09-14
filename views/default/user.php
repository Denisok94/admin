<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Пользователи';
// $this->params['breadcrumbs'][] = ['label' => "Админка", 'url' => '/admin-bar'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <?= $this->render('_menu', [
                'active' => 'users',
            ]) ?>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <?php print_r($User);

                    $rezult = '<table id="example1" class="table table-bordered table-hover">' . "\n<thead>";
                    $rezult .= "<tr><th>id</th><th>username</th><th>email</th><th>created_at</th><th>updated_at</th><th>blocked_at</th>";
                    $rezult .= "</tr></thead>\n<tbody>\n";
                    foreach ($User as $keys => $value) {
                        $rezult .=  "<tr>";
                        foreach ($value as $key => $values) {
                            switch ($key) {
                                case "id":
                                    $rezult .=  "<td>$values</td>";
                                    break;
                                case "username":
                                    $rezult .=  "<td>$values</td>";
                                    break;
                                case "email":
                                    $rezult .=  "<td>$values</td>";
                                    break;
                                case "blocked_at":
                                    $blocked = "<td>$values</td>";
                                    break;
                                case "created_at":
                                    $rezult .=  "<td>$values</td>";
                                    break;
                                case "updated_at":
                                    $rezult .=  "<td>$values</td>";
                                    break;
                                    // default:
                                    //     $rezult .=  "<td>$values</td>";
                            }
                        }
                        $rezult .=  "$blocked</tr>\n";
                    }
                    $rezult .= "</tfoot></table>\n";
                    echo $rezult;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>