<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">BACKEND - OPTICAR</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Historial cotizaciones</h2><br/>
                      
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="rut_cliente">Rut</option>
                                      <option value="patente_vehiculo">Patente</option>
                                    </select>
                                    <input type="text"  @keyup.enter="listarCliente(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarCliente(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Rut Cliente</th>
                                    <th>Pantente</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="reparacion in arrayReparacion" :key="reparacion.id">
                                    
                                    <td v-text="reparacion.rut_cliente"></td>
                                    <td v-text="reparacion.patente_vehiculo"></td>
                                    <td v-text="reparacion.monto_total"></td>
                                    <td v-text="reparacion.created_at"></td>
                                    

                                
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" @click="abrirModal(reparacion.id)">

                                          <i class="fa fa-edit fa-2x"></i> Detalle
                                        </button> &nbsp;
                                    </td>

                                    
                                </tr>
                               
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                </li>

                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                               
                               
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
         
           <div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>repuesto</th>
                                    <th>mantencion</th>
                                    <th>costo</th>
                                    <th>observacion</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="detalle in arraydetallereparacion" :key="detalle.id">
                                    
                                    <td v-text="detalle.repuesto"></td>
                                    <td v-text="detalle.mantencion"></td>
                                    <td v-text="detalle.costo"></td>
                                    <td v-text="detalle.observacion"></td>
                                    

                                
                                   

                                    
                                </tr>
                               
                            </tbody>
                        </table>
                        
                           

                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        
        </main>
</template>

<script>
   
    export default {
        
        data(){

            return {
               
                cliente_id:0,
                nombre : '',
                apellido : '',
                tipo_documento : 'CEDULA',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '', 
                arrayReparacion:[],
                arraydetallereparacion:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorCliente:0,
                errorMostrarMsjCliente:[],
                pagination:{
                   
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
           
                },
                pagination2:{
                   
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
           
                },
                offset:3,
                criterio:'rut_cliente',
                buscar:''
            }

        },

        computed:{

            isActived: function(){
              
              return this.pagination.current_page;

            },

             //calcula los elementos de la paginacion
            pagesNumber: function(){

                if(!this.pagination.to){
                    
                    return[];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                   
                   from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    
                   to = this.pagination.last_page; 
                }

                var pagesArray = [];
                while(from <= to){
                   
                   pagesArray.push(from);
                   from++;
                }
                return pagesArray;


            }

        },

        methods:{

           listarCliente(page,buscar,criterio){

               let me=this;

               var url= '/historial/cotizaciones?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayReparacion=respuesta.cotizacion.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
           },

           cambiarPagina(page,buscar,criterio){
              
              let me = this;

              //Actualiza  la pagina actual

               me.pagination.current_page=page;

               me.listarCliente(page,buscar,criterio);

           },

           registrarCliente(){

               if(this.validarCliente()){

                   return;
               }

               let me=this;

               axios.post('/cliente/registrar',{
                 
                    'nombre': this.nombre,
                    'apellido':this.apellido,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarCliente(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

           },

            actualizarCliente(){

                if(this.validarCliente()){

                   return;
               }

               let me=this;

               axios.put('/cliente/actualizar',{
                 
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,
                    'id':this.cliente_id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarCliente(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            validarCliente(){

                this.errorCliente=0;
                this.errorMostrarMsjCliente =[];

                if (!this.nombre) this.errorMostrarMsjCliente.push("(*)El nombre del cliente no puede estar vacío.");

                if (this.errorMostrarMsjCliente.length) this.errorCliente = 1;

                return this.errorCliente;
            },

           cerrarModal(){

                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.apellido='';
                this.tipo_documento='CEDULA';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.errorCliente=0;

           },

           abrirModal(id){
                 
               this.modal=1;
                this.tituloModal="Detalle";
                

               let me=this;

               var url= '/detallercotizacion?&criterio='+id;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.arraydetallereparacion=response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                        
           }
        
        },
        
        mounted() {
            //console.log('Component mounted.')
            this.listarCliente(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
           
     .modal-content{

      width:100% !important;
      position:absolute !important;
  }

  .mostrar{

      display:list-item !important;
      opacity:1 !important;
      position:absolute !important;
      background-color:#3c29297a !important;
  }

   .div-error{

      display:flex;
      justify-content:center;
  }

  .text-error{
      
      color:red !important;
      font-weight:bold;
      font-size:20px;
  }

</style>
