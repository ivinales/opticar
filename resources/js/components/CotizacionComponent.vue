<template>

  <main class="main" app>
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">BACKEND - OPTICAR</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    
                    <div class="card-body">
                        <v-stepper v-model="e1" >
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">Datos del cliente</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2">Datos del vehiculo</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step step="3">Cotizacion</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <div class="text-xs-center">
            <h1>Datos de cliente</h1>
          </div>
          <div class="text-xs-center">
            <v-btn color="primary" @click="e1 = 2">Continuar</v-btn>
          </div>
          <v-container grid-list-xl>
          <v-form>
              <v-layout wrap justify-space-between>
                <v-flex xs8 md8>
                  <v-text-field
                    v-model="buscador"
                    :rules="nameRules"
                    :counter="10"
                    label="Rut"
                    required
                    prepend-inner-icon="fingerprint"
                    
                  ></v-text-field>
                </v-flex>
                <v-flex md2>
                  <v-btn @click="listarCliente(1,buscador,'num_documento');" color="primary">Buscar</v-btn>
                  <v-btn  @click="abrirModal('cliente','registrar')" color="primary" >Crear</v-btn>
                </v-flex>
              </v-layout>
          </v-form>
          </v-container>
          <v-container grid-list-xl style="width:50%"  v-for="cliente in arrayCliente" :key="cliente.id">
            <v-form>
              <v-layout wrap justify-space-between>
                <v-flex xs12 md12>
                  <v-text-field
                    v-model="rut"
                    :rules="nameRules"
                    :counter="10"
                    label="Rut"
                    required
                    prepend-inner-icon="fingerprint"
                    v-text="cliente.num_documento"
                  ></v-text-field>
                </v-flex>
                
                <v-flex xs12 md12>
                  <v-text-field
                    v-model="nombre"
                    :rules="nameRules"
                    :counter="10"
                    label="Nombre"
                    required
                    prepend-inner-icon="account_circle"
                    v-text="cliente.nombre"
                  ></v-text-field>
                </v-flex>


                <v-flex xs12 md12>
                  <v-text-field
                    v-model="apellido"
                    :rules="nameRules"
                    :counter="10"
                    label="Apellido"
                    required
                    prepend-inner-icon="account_circle"
                    v-text="cliente.apellido"
                  ></v-text-field>
                </v-flex>

             

                <v-flex xs12 md12>
                  <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                    prepend-inner-icon="contact_mail"
                    v-text="cliente.email"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field
                    v-model="fono"
                    :rules="nameRules"
                    :counter="10"
                    label="Telefono"
                    required
                    prepend-inner-icon="phone"
                    v-text="cliente.telefono"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md12>
                  <v-text-field
                    v-model="Direccion"
                    :rules="nameRules"
                    :counter="10"
                    label="Direccion"
                    required
                    prepend-inner-icon="place"
                    v-text="cliente.direccion"
                  ></v-text-field>
                </v-flex>

                <!-- <v-flex xs12 md6>
                <v-slider v-model="max" label="Max characters"></v-slider>

                <v-checkbox v-model="allowSpaces" label="Allow spaces"></v-checkbox>

                <v-text-field v-model="match" label="Value must match"></v-text-field>
                </v-flex>-->
              </v-layout>
            </v-form>
            
          </v-container>
          
          
          <div class="text-xs-center">
            <v-btn color="primary" @click="e1 = 2">Continuar</v-btn>
          </div>
        </v-stepper-content>

        <v-stepper-content step="2">
          <div class="text-xs-center">
            <h1>Datos del Vehiculo</h1>
          </div>
          <div class="text-xs-center">
            <v-btn text @click="e1 = 1">Volver</v-btn>
            <v-btn color="primary" @click="e1 = 3">Continuar</v-btn>
          </div>
          <v-container grid-list-xl>
          <v-form>
              <v-layout wrap justify-space-between>
                <v-flex xs8 md8>
                  <v-text-field
                    v-model="buscadorVehiculo"
                    :rules="nameRules"
                    :counter="10"
                    label="Pantete"
                    required
                    prepend-inner-icon="fingerprint"
                    
                  ></v-text-field>
                </v-flex>
                <v-flex md2>
                  <v-btn @click="listarVehiculo(1,buscadorVehiculo,'patente');" color="primary">Buscar</v-btn>
                  <v-btn  @click="abrirModal2('vehiculo','registrar')" color="primary" >Crear</v-btn>
                </v-flex>
              </v-layout>
          </v-form>
          </v-container>
          <v-container grid-list-xl style="width:50%"  v-for="vehiculo in arrayVehiculo" :key="vehiculo.id">
            <v-form>
              <v-layout wrap justify-space-between>
                <v-flex xs12 md10>
                  <v-text-field
                    v-model="patente"
                    :rules="nameRules"
                    :counter="10"
                    label="Patente"
                    required
                    prepend-inner-icon="library_books"
                    v-text="vehiculo.patente"
                  ></v-text-field>
                </v-flex>
                
                <v-flex xs12 md12>
                  <v-text-field
                    v-model="marca"
                    :rules="nameRules"
                    :counter="10"
                    label="Marca"
                    required
                    prepend-inner-icon="directions_car"
                    v-text="vehiculo.marca"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field
                    v-model="modelo"
                    :rules="nameRules"
                    :counter="10"
                    label="Modelo"
                    required
                    prepend-inner-icon="directions_car"
                    v-text="vehiculo.modeloVehiculo"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field
                    v-model="anio"
                    :rules="nameRules"
                    :counter="10"
                    label="Año"
                    required
                    prepend-inner-icon="date_range"
                    v-text="vehiculo.anio"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field
                    v-model="odometro"
                    :rules="nameRules"
                    :counter="10"
                    label="Odometro"
                    required
                    prepend-inner-icon="speed"
                    v-text="vehiculo.kilometraje"
                  ></v-text-field>
                </v-flex>

                <!-- <v-flex xs12 md6>
                <v-slider v-model="max" label="Max characters"></v-slider>

                <v-checkbox v-model="allowSpaces" label="Allow spaces"></v-checkbox>

                <v-text-field v-model="match" label="Value must match"></v-text-field>
                </v-flex>-->
              </v-layout>
            </v-form>
          </v-container>
          <div class="text-xs-center">
            <v-btn text @click="e1 = 1">Volver</v-btn>
            <v-btn color="primary" @click="e1 = 3">Guardar</v-btn>
          </div>
        </v-stepper-content>

        <v-stepper-content step="3">
          <div class="text-xs-center">
            <h1>Datos de la Cotizacion</h1>
          </div>
          <v-container grid-list-xl>
            <!-- <v-form> -->
            <v-layout>
              <v-flex xs12 md4>
                <v-text-field
                  v-model="respuesto"
                  :rules="nameRules"
                  :counter="10"
                  label="Repuesto"
                  required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 md4>
                <v-text-field
                  v-model="mantencion"
                  :rules="nameRules"
                  :counter="10"
                  label="Mantencion"
                  required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 md4>
                <v-text-field
                  v-model="costo"
                  :rules="nameRules"
                  :counter="10"
                  label="Costo"
                  required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 md4>
                <v-text-field
                  v-model="observacion"
                  :rules="nameRules"
                  :counter="10"
                  label="Observacion"
                  required
                ></v-text-field>
              </v-flex>
              <v-flex xs12 md4>
                <v-btn text @click="agregar()">Agregar</v-btn>
              </v-flex>
            </v-layout>

            <v-flex xs12 md12>
              <v-data-table :headers="headers" :items="productosAdd" class="elevation-1">
                <template v-slot:items="props">
                  <!-- <td>{{ props.item.id }}</td> -->
                  <tr>
                    <td>{{ props.item.resp}}</td>
                    <td>{{ props.item.mant}}</td>
                    <td>{{ props.item.cost}}</td>
                    <td>{{ props.item.obs}}</td>
                  </tr>

                  <!-- <td class="layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
                  </td>-->
                </template>
                <!-- <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
                </template>-->
                <template v-slot:footer>
                  <td :colspan="headers.length">el total es : {{total}}</td>
                </template>
              </v-data-table>
            </v-flex>
            <div class="text-xs-center">
              <v-form @submit.prevent="cotizacion">
                <v-btn type="submit" color="primary">Generar Cotizacion</v-btn>
              </v-form>
              <v-form @submit.prevent="reparacion">
                <v-btn type="submit" color="primary">Generar Reparacion</v-btn>
              </v-form>
            </div>

            <!-- </v-form> -->
          </v-container>
          <div class="text-xs-center">
            <v-btn text @click="e1 = 2">Volver</v-btn>
            <v-btn color="primary" @click="e1 = 1">Guardar</v-btn>
          </div>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
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
                            
                            <div v-show="errorCliente" class="form-group row div-error">
                                
                                <div class="text-center text-error">
                                    
                                    <div v-for="error in errorMostrarMsjCliente" :key="error" v-text="error"></div>

                                </div>
                            
                            </div>
                             

                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del cliente">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido" class="form-control" placeholder="Apellido del cliente">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <select v-model="tipo_documento" class="form-control">
                                            <option value="DNI">DNI</option>
                                            <option value="CEDULA">CEDULA</option>
                                            <option value="PASS">PASS</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Número</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="num_documento" class="form-control" placeholder="Número de documento">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Teléfono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                               

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" @click="registrarCliente()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" @click="actualizarCliente()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

             <div class="modal fade" :class="{'mostrar':modal2}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" @click="cerrarModal2()" class="close" aria-label="Close">
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
                            <button type="button" @click="cerrarModal2()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" @click="registrarVehiculo()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" @click="actualizarVehiculo()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
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
    data () {
      return {
        e1: 0, total: 0,productosAdd: [],respuesto: "",
      mantencion: "",
      costo: null,
      observacion: "",
                errorMostrarMsjCliente:[],
        arrayCliente:[],
        items:[],
        nombre:'',
        apellido:'',
        direccion:'',
        telefono:'',
        tipoAccion:0,
        num_documento:'',
        tipo_documento:'',
        errorCliente:0,
        tituloModal:'',mantencion: "",
         modal:0,
         modal2:0,
         respuesto:'',
         odometro:'',
         anio:'',
         modelo:'',
         marca:'',
         patente:'',
         buscador:'',
         buscadorVehiculo:'',
         form: {
        rut: null,
        name: null,
        Snombre: null,
        Papellido: null,
        Sapellido: null,
        fono: null,
        email: null,
        password: null,
        rol: null
      },
         costo: null,
         nameRules: [
        v => !!v || "Este campo es requerido.",
        v => v.length <= 10 || "Excede el maximo de caracteres."
      ],
      email: "",
      emailRules: [
        v => !!v || "El E-mail es requerido.",
        v => /.+@.+/.test(v) || "E-mail  no valido"
      ],
      headers: [
        { text: "REPUESTO", value: "repuesto" },
        { text: "MANTENCION", value: "mantencion" },
        { text: "COSTO", value: "costo" },
        { text: "OBSERVACION", value: "observacion" }
      ],form3: {
        productos: null,
        totalboleta: null,
        patentevehiculo: null,
        rutboleta: null
      },
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
       observacion: "",
       
      }
    },
    methods: {
      listarCliente(page,buscar,criterio){
        if (this.buscador=="") {
          alert("El campo rut esta vacio")
        }else{


               let me=this;

               var url= '/cliente?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    me.rutBoleta=buscar;
                    // console.log(response);
                    var respuesta = response.data;
                    me.arrayCliente=respuesta.clientes.data;
                    // me.pagination= respuesta.pagination;
                    me.nombre=response.cliente.nombre;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        }

           },
           abrirModal(modelo,accion,data=[]){
                 
                 switch(modelo){

                    case "cliente":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                    this.modal = 1;
                                    this.tituloModal = 'Agregar Cliente';
                                    this.nombre= '';
                                    this.apellido= '';
                                    this.tipo_documento='CEDULA';
                                    this.num_documento='';
                                    this.direccion='';
                                    this.telefono='';
                                    this.email='';
                                    this.tipoAccion = 1;
                                    break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal=1;
                                    this.tituloModal='Editar Cliente';
                                    this.tipoAccion=2;
                                    this.cliente_id=data['id'];
                                    this.nombre = data['nombre'];
                                    this.apellido = data['apellido'];
                                    this.tipo_documento = data['tipo_documento'];
                                    this.num_documento = data['num_documento'];
                                    this.telefono = data['telefono'];
                                    this.email = data['email'];
                                    this.direccion = data['direccion'];
                                    break;
                                }
                        
                        }


                    }

                }

                        
           },
           abrirModal2(modelo,accion,data=[]){
                 
                switch(modelo){

                    case "vehiculo":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                    this.modal2 = 1;
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
           
           cotizacion() {
      if (this.buscador=="" || this.buscadorVehiculo=="" || this.productosAdd=="" ) {
        alert("Existen campos sin rellenar.")
      }else{
this.form3.productos = this.productosAdd;
      this.form3.totalboleta = this.total;
      this.form3.rutboleta = this.rutBoleta;  
      this.form3.patentevehiculo = this.patente;
      console.log(this.form3);
      axios
        .post("/cotizacion/registrar", this.form3)
        .then(res => {
          //User.resposeAfterLogin(res)
          alert("agregado con éxito");
        })
        .catch(error => {
          // this.errors = error.response.data.errors;
          alert(error);
        });
      }
      
    },
    reparacion() {
      if (this.buscador=="" || this.buscadorVehiculo=="" || this.productosAdd=="" ) {
        alert("Existen campos sin rellenar.")
      }else{
       this.form3.productos = this.productosAdd;
      this.form3.totalboleta = this.total;
      this.form3.rutboleta = this.rutBoleta;
      this.form3.patentevehiculo = this.patente;
      console.log(this.form3);
      axios
        .post("/reparacion/registrar", this.form3)
        .then(res => {
          //User.resposeAfterLogin(res)
          alert("agregado con éxito");
        })
        .catch(error => {
          // this.errors = error.response.data.errors;
          alert(error);
        });
      }
     
    },
        agregar() {
          if (this.respuesto=="" || this.mantencion==""&&this.observacion==""&&this.costo=="") {
            alert("Existe campos sin completar")
          }else{
             this.prodcuto = {
        resp: this.respuesto,
        mant: this.mantencion,
        obs: this.observacion,
        cost: this.costo
      };
      console.log(this.costo);
      console.log(this.total);
      this.total = parseInt(this.total) + parseInt(this.costo);
      this.productosAdd.push(this.prodcuto);
          }
     
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
            cerrarModal2(){

                this.modal2=0;
                this.tituloModal='';
                this.marca='';
                this.modelo='';
                this.patente='';
                this.anio='';
                this.kilomeetraje='';
                this.errorVehiculo=0;

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

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });

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
                    me.cerrarModal2();
                    // me.listarVehiculo(1,'','nombre');

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

            listarVehiculo(page,buscar,criterio){
              if (this.buscadorVehiculo=="") {
                alert("El campo patente esta vacio")
              }else{

               let me=this;

               var url= '/vehiculo?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.patente=buscar;
                    var respuesta = response.data;
                    me.arrayVehiculo=respuesta.vehiculo.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
              }
           
           },
            validarVehiculo(){

                this.errorVehiculo=0;
                this.errorMostrarMsjVehiculo =[];

                if (!this.patente) this.errorMostrarMsjVehiculo.push("(*)La patente no puede estar vacía.");

                if (this.errorMostrarMsjVehiculo.length) this.errorVehiculo = 1;

                return this.errorVehiculo;
            },


    },
  
  }
</script>
<style>
.application{
  width: 100%!important;
}
</style>
