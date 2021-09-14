<?php

use yii\helpers\Html;
?>
<ul class="nav nav-tabs">
    <li class="<?php if ($active == "users") echo "active"; ?>"><a href="defult/users">Пользователи</a></li>
    <li class="<?php if ($active == "rbac1") echo "active"; ?>"><a href="defult/rbac/?type=1">Роли</a></li>
    <li class="<?php if ($active == "rbac2") echo "active"; ?>"><a href="defult/rbac/?type=2">Разрешения</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">Добавить<span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Пользователя</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Роль</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Разрешение</a></li>
        </ul>
    </li>
</ul>