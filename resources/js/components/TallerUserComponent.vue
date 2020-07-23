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

                       <h2>Listado de Asignaciones</h2><br/>
                      
                        <button class="btn btn-primary btn-lg" type="button" @click="abrirModal('usuario','registrar')">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar asignacion
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
                                    <input type="text"  @keyup.enter="listarTallerUser(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarTallerUser(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Nombre Taller</th>
                                    <th>Direccion</th>
                                    <!-- <th>Estado</th> -->
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>email</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="talleruser in arrayTallerUser" :key="talleruser.id">
                                    
                                    <td v-text="talleruser.nombre"></td>
                                    <td v-text="talleruser.direccion"></td>
                                    <!-- <td v-text="talleruser.estado"></td> -->
                                    <td v-text="talleruser.nombre"></td>
                                    <td v-text="talleruser.num_documento"></td>
                                    <td v-text="talleruser.email"></td>
                                    
                                
                                    

                                   

                                    
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
                            
                            <div v-show="errorUsuario" class="form-group row div-error">
                                
                                <div class="text-center text-error">
                                    
                                    <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error"></div>

                                </div>
                            
                            </div>
                             

                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                 

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Usuario</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idUser">
                                            <option value="0">Seleccione un N° de documento</option>
                                            <option v-for="user in arrayUser" :key="user.id" :value="user.id" v-text="user.nombre + ' - ' + user.num_documento">

                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Taller</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idtaller">
                                            <option value="0">Seleccione un taller</option>
                                            <option v-for="taller in arrayTaller" :key="taller.id" :value="taller.id" v-text="taller.nombre">

                                            </option>
                                        </select>
                                    </div>
                                </div>  

                                       

                                
                               

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" @click="registrarTallerUser()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" @click="actualizarUsuario()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
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
               
                usuario_id:0,
                nombre : '',
                tipo_documento : 'CEDULA',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '', 
                usuario:'',
                password:'',
                idUser:0,
                idtaller:0,
                imagen:'',
                arrayUsuario:[],
                arrayTallerUser:[],
                arrayUser:[],
                arrayTaller:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorUsuario:0,
                errorMostrarMsjUsuario:[],
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

           listarTallerUser(page,buscar,criterio){

               let me=this;

               var url= '/TallerUser?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayTallerUser=respuesta.talleruser.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
           },

           selectUsuario(){
               
               let me=this;
                var url= '/user/selectUser';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUser = respuesta.user;
                })
                .catch(function (error) {
                    console.log(error);
                });

           },
            selectTaller(){
               
               let me=this;
                var url= '/taller/selectTaller';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayTaller = respuesta.taller;
                })
                .catch(function (error) {
                    console.log(error);
                });

           },

           cambiarPagina(page,buscar,criterio){
              
              let me = this;

              //Actualiza  la pagina actual

               me.pagination.current_page=page;

               me.listarTallerUser(page,buscar,criterio);

           },

           registrarTallerUser(){

               if(this.validarUsuario()){

                   return;
               }

               let me=this;

               axios.post('/TallerUser/registrar',{
                 
                    'taller': this.idtaller,
                    'user': this.idUser,


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarTallerUser(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

           },
            
            subirImagen(e){
                
                let me=this;

                let file = e.target.files[0];
             
                //console.log(file);

                let reader = new FileReader();

                reader.onloadend = (file) => {
                    
                    //console.log('RESULT', reader.result)

                    me.imagen = reader.result;
                }
                reader.readAsDataURL(file);
            },

            actualizarUsuario(){

                if(this.validarUsuario()){

                   return;
               }

               let me=this;

               axios.put('/user/actualizar',{
                 
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol' : this.idrol,
                    'imagen':this.imagen,
                    'id': this.usuario_id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarTallerUser(1,'','nombre');

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            validarUsuario(){

                this.errorUsuario=0;
                this.errorMostrarMsjUsuario =[];

                
                if (this.idUser==0) this.errorMostrarMsjUsuario.push("(*)Debes seleccionar algun usuario.");
                if (this.idtaller==0) this.errorMostrarMsjUsuario.push("(*)Debes seleccionar un taller.");
                

                if (this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

                return this.errorUsuario;
            },

           cerrarModal(){

                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.tipo_documento='CEDULA';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.imagen='';
                this.errorUsuario=0;

           },

           abrirModal(modelo,accion,data=[]){

                this.selectUsuario();
               this.selectTaller();
                 switch(modelo){

                    case "usuario":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                    this.modal = 1;
                                    this.tituloModal = 'Agregar Usuario';
                                    this.nombre= '';
                                    this.tipo_documento='CEDULA';
                                    this.num_documento='';
                                    this.direccion='';
                                    this.telefono='';
                                    this.email='';
                                    this.usuario='';
                                    this.password='';
                                    this.idrol=0;
                                    this.tipoAccion = 1;
                                    break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal=1;
                                    this.tituloModal='Editar Usuario';
                                    this.tipoAccion=2;
                                    this.usuario_id=data['id'];
                                    this.nombre = data['nombre'];
                                    this.tipo_documento = data['tipo_documento'];
                                    this.num_documento = data['num_documento'];
                                    this.direccion = data['direccion'];
                                    this.telefono = data['telefono'];
                                    this.email = data['email'];
                                    this.usuario = data['usuario'];
                                    this.password = data['password'];
                                    this.idrol = data['idrol'];
                                    break;
                                }
                        
                        }


                    }

                }

                        
           },

              desactivarUsuario(id){
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
                axios.put('/user/desactivar',{

                    'id':id

                })
                .then(function (response) {
                    // handle success
                    // console.log(response);
                    me.listarTallerUser(1,'','nombre');
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
            activarUsuario(id){
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
                axios.put('/user/activar',{

                    'id':id

                })
                .then(function (response) {
                    // handle success
                    // console.log(response);
                    me.listarTallerUser(1,'','nombre');
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
            this.listarTallerUser(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
           
     .modal-content{

      width:100% !important;
      position:absolute !important;
  }

  .mostrar{
      height:1000px;
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
