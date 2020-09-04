<li class="header">MENŰ</li>
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><img src="http://priestago.hu/tarca/public/img/menu/dashboard_25.png"><span> Vezérlő pult</span></a>
</li>
<li class="{{ Request::is('todos*') ? 'active' : '' }}">
    <a href="{!! route('todos.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/todo_25.png"><span> Feladat</span></a>
</li>
<li class="treeview">
    <a href="#">
      <img src="http://priestago.hu/tarca/public/img/menu/crm_25.png">
      <span> CRM</span>
      <span class="pull-right-container">
        <span class="fa fa-angle-left pull-right"></span>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('partners*') ? 'active' : '' }}">
            <a href="{!! route('partners.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/partner_25.png"><span> Partner</span></a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
      <img src="http://priestago.hu/tarca/public/img/menu/keszlet_25.png">
      <span> Készlet</span>
      <span class="pull-right-container">
        <span class="fa fa-angle-left pull-right"></span>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('termekfocsoports*') ? 'active' : '' }}">
            <a href="{!! route('termekfocsoports.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/termekcsoport_25.png"><span> Termék csoport</span></a>
        </li>
<!--
        <li class="{{ Request::is('termekcsoports*') ? 'active' : '' }}">
            <a href="{!! route('termekcsoports.index') !!}"><i class="fa fa-edit"></i><span>Termekcsoports</span></a>
        </li>
-->
        <li class="{{ Request::is('termeks*') ? 'active' : '' }}">
            <a href="{!! route('termeks.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/products_25.png"><span> Termék</span></a>
        </li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <img src="http://priestago.hu/tarca/public/img/menu/penzugy_25.png">
        <span> Pénzügy</span>
        <span class="pull-right-container">
            <span class="fa fa-angle-left pull-right"></span>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('koltsegfocsoports*') ? 'active' : '' }}">
            <a href="{!! route('koltsegfocsoports.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/ktgfocsoport_25.png"><span> Költség nem</span></a>
        </li>
        <li class="{{ Request::is('szamlas*') ? 'active' : '' }}">
            <a href="{!! route('szamlas.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/szamla_25.png"><span> Szamla</span></a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
      <img src="http://priestago.hu/tarca/public/img/menu/szotar_25.png">
      <span> Szótár</span>
      <span class="pull-right-container">
        <span class="fa fa-angle-left pull-right"></span>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ Request::is('telepules*') ? 'active' : '' }}">
          <a href="{!! route('telepules.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/telepules_25.png"><span> Település</span></a>
      </li>
      <li class="{{ Request::is('dictionaries*') ? 'active' : '' }}">
          <a href="{!! route('dictionaries.index') !!}"><img src="http://priestago.hu/tarca/public/img/menu/szotar_25.png"><span> Szótár</span></a>
      </li>
    </ul>
</li>
