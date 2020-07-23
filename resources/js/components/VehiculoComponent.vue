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

                       <h2>Listado de Vehiculos</h2><br/>
                      
                        <button class="btn btn-primary btn-lg" type="button" @click="abrirModal('vehiculo','registrar')">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Vehiculos
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Documento</option>
                                      <option value="email">Email</option>
                                      <option value="telefono">Teléfono</option>
                                    </select>
                                    <input type="text"  @keyup.enter="listarCliente(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarCliente(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Patente</th>
                                    <th>Año</th>
                                    <th>kilometraje</th>
                                    <th>Editar</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="vehiculo in arrayVehiculo" :key="vehiculo.id">
                                    
                                    <td v-text="vehiculo.marca"></td>
                                    <td v-text="vehiculo.modeloVehiculo"></td>
                                    <td v-text="vehiculo.patente"></td>
                                    <td v-text="vehiculo.anio"></td>
                                    <td v-text="vehiculo.kilometraje"></td>

                                
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" @click="abrirModal('vehiculo','actualizar',vehiculo)">

                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>
                                    <td>

                                        <template v-if="vehiculo.estado">
                                            <button type="button" class="btn btn-success btn-sm" @click="desactivarVehiculo(vehiculo.id)">
                                                <i class="fa fa-unlock fa-2x"></i> Activado
                                            </button>
                                        </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="activarVehiculo(vehiculo.id)">
                                                <i class="fa fa-lock fa-2x"></i> Desactivado
                                            </button>
                                        </template>
                                       
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
            <!--Inicio del modal agregar/actualizar-->
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
                            
                            <div v-show="errorVehiculo" class="form-group row div-error">
                                
                                <div class="text-center text-error">
                                    
                                    <div v-for="error in errorMostrarMsjVehiculo" :key="error" v-text="error"></div>

                                </div>
                            
                            </div>
                             

                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="marca" class="form-control" placeholder="Nombre de la marca">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Modelo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="modelo" class="form-control" placeholder="Nombre del modelo">                                        
                                    </div>
                                </div>
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Patente</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="patente" class="form-control" placeholder="Ingresar la patente">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Año</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="anio" class="form-control" placeholder="Año del vehiculo">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Kilometraje</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="kilomeetraje" class="form-control" placeholder="Cantidad de kilometraje">                                        
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" @click="registrarVehiculo()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" @click="actualizarVehiculo()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
        
        </main>
</template>

<script>
   
    export default {
        data(){

            return {
               
                vehiculo_id:0,
                marca : '',
                modelo : '',
                patente : '',
                anio : '',
                kilomeetraje : '',
                arrayVehiculo:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorVehiculo:0,
                errorMostrarMsjVehiculo:[],
                pagination:{
                   
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
           
                },
                offset:3,
                criterio:'nombre',
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

           listarVehiculo(page,buscar,criterio){

               let me=this;

               var url= '/vehiculo?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayVehiculo=respuesta.vehiculo.data;
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

               me.listarVehiculo(page,buscar,criterio);

           },

           registrarVehiculo(){

               if(this.validarVehiculo()){

                   return;
               }

               let me=this;

               axios.post('/vehiculo/registrar',{
                 
                    'marca': this.marca,
                    'modelo':this.modelo,
                    'patente': this.patente,
                    'anio' : this.anio,
                    'kilometraje' : this.kilomeetraje,


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarVehiculo(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

           },

            actualizarVehiculo(){

                if(this.validarVehiculo()){

                   return;
               }

               let me=this;
                console.log(this.vehiculo_id)
               axios.put('/vehiculo/actualizar',{
                 
                    'marca': this.marca,
                    'modelo':this.modelo,
                    'patente': this.patente,
                    'anio' : this.anio,
                    'kilometraje' : this.kilomeetraje,
                    'id':this.vehiculo_id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarVehiculo(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            validarVehiculo(){

                this.errorVehiculo=0;
                this.errorMostrarMsjVehiculo =[];

                if (!this.patente) this.errorMostrarMsjVehiculo.push("(*)La patente no puede estar vacía.");

                if (this.errorMostrarMsjVehiculo.length) this.errorVehiculo = 1;

                return this.errorVehiculo;
            },

           cerrarModal(){

                this.modal=0;
                this.tituloModal='';
                this.marca='';
                this.modelo='';
                this.patente='';
                this.anio='';
                this.kilomeetraje='';
                this.errorVehiculo=0;

           },

           abrirModal(modelo,accion,data=[]){
                 
                 switch(modelo){

                    case "vehiculo":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                    this.modal = 1;
                                    this.tituloModal = 'Agregar Vehiculo';
                                    this.marca='';
                                    this.modelo='';
                                    this.patente='';
                                    this.anio='';
                                    this.kilomeetraje='';
                                    this.tipoAccion = 1;
                                    break;
                                
                                }

                                case "actualizar":

                                {
                                    console.log(data);
                                    this.modal=1;
                                    this.tituloModal='Editar Vehiculo';
                                    this.tipoAccion=2;
                                    this.vehiculo_id=data['id'];
                                    this.marca=data['marca'];
                                    this.modelo=data['modeloVehiculo'];
                                    this.patente=data['patente'];
                                    this.anio=data['anio'];
                                    this.kilomeetraje=data['kilometraje'];
                                    break;
                                }
                        
                        }


                    }

                }

                        
           },
           desactivarVehiculo(id){
                  const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Estas seguro de desactivar este usuario?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar <i class="fa fa-check fa-2x></i>',
            cancelButtonText: 'Cancelar <i class="fa fa-times fa-2x></i>',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me =this;
                axios.put('/vehiculo/desactivar',{

                    'id':id

                })
                .then(function (response) {
                    // handle success
                    // console.log(response);
                    me.listarVehiculo(1,'','nombre');
                    swalWithBootstrapButtons.fire(
                    'Desactivado!',
                    'La categoria ha sido desactivado con éxito',
                    'success'
                    )
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                // 'Cancelled',
                // 'Your imaginary file is safe :)',
                // 'error'
                // )
            }
            })
            },
            activarVehiculo(id){
                  const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Estas seguro de Activar este usuario?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar <i class="fa fa-check fa-2x></i>',
            cancelButtonText: 'Cancelar <i class="fa fa-times fa-2x></i>',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me =this;
                axios.put('/vehiculo/activar',{

                    'id':id

                })
                .then(function (response) {
                    // handle success
                    // console.log(response);
                    me.listarVehiculo(1,'','nombre');
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'La categoria ha sido Activado con éxito',
                    'success'
                    )
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                // 'Cancelled',
                // 'Your imaginary file is safe :)',
                // 'error'
                // )
            }
            })
            },
        
        },
        
        mounted() {
            //console.log('Component mounted.')
            this.listarVehiculo(1,this.buscar,this.criterio);
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
