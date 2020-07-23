<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item" >
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Dashbord</a>
            </li>
            <li class="nav-title">
                Menú
            </li>

           
           
            
           
            <li @click="menu=11" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Horario</a>
            </li>
            
            <li @click="menu=13" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Mapa de ayuda</a>
            </li>
            <li @click="menu=20" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Presupuesto</a>
            </li>
            <li @click="menu=21" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Reparacion</a>
            </li>
            <li @click="menu=22" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Historial Reparaciones</a>
            </li>
            <li @click="menu=40" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Historial Cotizaciones</a>
            </li>
            {{--<li @click="menu=22" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Fallas a futuro **</a>
            </li>--}}
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>