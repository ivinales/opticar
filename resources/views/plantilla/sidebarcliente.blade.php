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
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Talleres</a>
            </li>
            <li @click="menu=13" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Mapa de Ayuda</a>
            </li>
           {{-- <li @click="menu=14" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Fallas a futuro****</a>
            </li>--}}
            <li @click="menu=17" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Reparaciones</a>
            </li>
            <li @click="menu=41" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Historial Reparacion</a>
            </li>
            <li @click="menu=42" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Historial Cotizacion</a>
            </li>
            
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>