<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">BACKEND - OPTICAR</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card mx-auto" >

                    <div class="card-header">

                       <h2>Listado de Talleres</h2><br/>
                      
                        <button v-if="tipo_cuenta==1" class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal" @click="abrirModal('taller','registrar')">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Taller
                        </button>
                    </div>
                  <div class="container fluid grid-list-lg">
                    <div class="row wrap">
                      <div class="xs12 md3 " v-for="taller in arrayTaller" :key="taller.id">
                      <div class="card taller" style="width: 18rem;">
                      <div class="card-body">
                        <h5 class="card-title" v-text="taller.nombre"></h5>
                        <h6 class="card-subtitle mb-2 text-muted" v-text="taller.direccion"></h6>
                        <!-- <p class="card-text">Texto de ejemplo.</p> -->
                        <a  v-if="tipo_cuenta==1" href="#" class="card-link"  @click="abrirModal('taller','actualizar',taller)">Editar</a>
                        <!-- <a href="#" class="card-link" @click="verReserva(taller)" >Ver Reservas</a> -->
                        <a href="#" class="card-link" @click="abrirModal2('taller','registrar',taller)">Ver Reservas</a>
                      </div>
                    </div>
                      </div>
                    
                    </div>
                    

                    
                </div>
                <!-- Fin ejemplo de tabla Listado -->
                  </div>

            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none ; " aria-hidden="true"  >
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close"  aria-label="Close" @click="cerrarModal()">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <div  v-show="errorTaller" class="form-group row div-error">
                                
                                <div class="text-center text-error">
                                    
                                    <div v-for="error in errorMostrarMsjTaller" :key="error" v-text="error"></div>

                                </div>
                            
                            </div>
                             

                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Taller</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del taller">
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese una direccion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Color</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="color" class="form-control" placeholder="Ingrese un color">
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label for="inputPassword" class="col-md-3 form-control-label">Estado</label>
                                    <div class="col-md-9">

                                <select class="form-control col-md-3" v-model="estado">
                                      <option value="1">Activo</option>
                                      <option value="0">Inactivo</option>
                                 </select>
                                  </div>
                                </div>
                                



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click="cerrarModal()"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" class="btn btn-success" v-if="tipoAccion==1" @click="registrarTaller()"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" class="btn btn-success" v-if="tipoAccion==2" @click="actualizarTaller()"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           <!-- -------------------------------------------------------------------------- -->
           <div class="modal fade" :class="{'mostrar':modal2}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; z-index:1020" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close"  aria-label="Close" @click="cerrarModal2()">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                             <div>
    <v-progress-circular indeterminate :size="50" :width="5" color="white" v-if="loading"></v-progress-circular>

    <notifications group="notificacion" position="bottom center" />
    <vue-scheduler
      :events="events"
      :event-dialog-config="dialogConfig"
      :event-display="eventDisplay"
      @event-clicked="eventClicked"
      @event-created="eventCreated"
      @month-changed="monthChanged"
    />
    <EventDialog
      v-model="showEventDialog"
      :event="eventSelected"
      @borrarEvento="eventoBorradoDialog"
    />
    






<div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none ; " aria-hidden="true"  >
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                        </div>
                       
                        <div class="modal-body">
                            
                            
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

























  </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click="cerrarModal2()"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            
        </main>
</template>

<script>
import EventDialog from "./EventDialog";

import moment from "moment";

    export default {
         props: ['id_cuenta','tipo_cuenta'],


        data(){
    return{
        identificador_taller:'',
        menu:null,
        taller_id:0,
        nombre:'',
        direccion:'',
        color:'',
        estado:0,
        arrayTaller:[],
        modal:0,
        modal2:0,
        tituloModal:'',
        tipoAccion:0,
        errorTaller:0,
        errorMostrarMsjTaller:[],
        pagination:{      
            'total':0,         
            'current_page':0,    
            'per_page':0,  
            'last_page':0,     
            'from':0,    
            'to':0          
        },
        offset:3,
        criterio:'nombre',
        buscar:'',
        // ------------------------------------------
        showEventDialog: false,
      eventSelected: null,
      taller_id: null,
      usuario: null,
      mes: null,
      loading: false,
      events: [],
      dialogConfig: {
        fields: [
          {
            name: "name",
            label: "Motivo Reserva",
            required: true
          },
          {
            name: "user",
            label: "Usuario",
            value: "",
            required: true,
            readonly: true
          }
        ]
      }
    }
},
        computed: {
        },
    
       
        

        methods:{
          borrarEvento(event){
      if(this.fechaPasado(event.date)){
          this.show=false
          this.$emit('borrarEvento', false)
      }else{
        axios
        .request({
          url: `/api/reserva/${event.id}`,
          method: "delete",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        })
        .then((res) => {
            this.show=false
            this.$emit('borrarEvento', true)
        })
          .catch((error) => {
            this.$emit('borrarEvento', false)
        })  
      }

    },
    cerrarDialog(){
      this.show=false
    },
    fechaPasado(fecha){
      let hoy = new Date();
      hoy.setHours(0,0,0,0);  
      return fecha < hoy
    },
            cargartodo(){
            this.taller_id = this.identificador_taller;
            // alert(this.identificador_taller)
            this.usuario = "probnado";
            this.dialogConfig.fields[1].value = this.usuario.name;
            let hoy = new Date();
            this.mes = hoy.getMonth() + 1;
            this.cargarEventos(this.mes);
        },
        listarTaller(){
          if (this.tipo_cuenta ==1 || this.tipo_cuenta==3) {
           let me=this;
            axios.get('/taller')
            .then(function (response) {
               
                 me.arrayTaller=response.data;
                // me.pagination=respuesta.pagination;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
          }
          if (this.tipo_cuenta == 2) {
            // alert('mecanico')
             let me=this;
             
            axios.get('/taller/mecanico',
            {
             'id_cuenta': this.id_cuenta
            })
            .then(function (response) {
               
                 me.arrayTaller=response.data;
                // me.pagination=respuesta.pagination;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
          }
          if (this.tipo_cuenta==3) {
            // alert('usuario')
          }
           
        },
        registrarTaller(){

            if (this.validarTaller()) {
                return;
            }
            let me =this;
            axios.post('/taller/registrar',{

                'nombre':this.nombre,
                'direccion':this.direccion,
                'color':this.color,
                'estado':this.estado

            })
            .then(function (response) {
                // handle success
                // console.log(response);
                me.cerrarModal();
                me.listarTaller();
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },
        actualizarTaller(){
            if (this.validarTaller()) {
                return;
            }
            
            let me =this;
            axios.put('/taller/actualizar',{

                'nombre':this.nombre,
                'direccion':this.direccion,
                'color':this.color,
                'estado':this.estado,
                'id':this.taller_id

            })
            .then(function (response) {
                // handle success
                // console.log(response);
                me.cerrarModal();
                me.listarTaller();
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },
        verReserva(taller) {
        localStorage.taller_id = taller.id;
        // this.$bus.$emit("cambiarTextoTitulo", taller.nombre);
    },
         validarTaller(){

            this.errorTaller=0;
            this.errorMostrarMsjTaller=[];
            if (!this.nombre) {
                this.errorMostrarMsjTaller.push("(*)El nombre del taller no puede estar vacio");
            }
            if (this.errorMostrarMsjTaller.length) {
                this.errorTaller=1;
            }
            return this.errorTaller;

        },
        
        abrirModal(modelo,accion,data=[]){
            switch(modelo){

                    case "taller":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                   this.modal=1;
                                   this.tituloModal="Registrar Taller";
                                   this.nombre="";
                                   this.descripcion="";
                                   this.tipoAccion=1;
                                   break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal=1;
                                    this.tituloModal="Editar Taller";
                                    this.tipoAccion=2;
                                    this.taller_id=data["id"];
                                    this.nombre=data["nombre"];
                                    this.direccion=data["direccion"];
                                    this.color=data["color"];
                                    this.estado=data["estado"];
                                    break;
                                }
                        
                        }


                    }

                }

        },
        abrirModal2(modelo,accion,data=[]){
            this.identificador_taller=data['id'];
            this.cargartodo();
            switch(modelo){

                    case "taller":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                   this.modal2=1;
                                   this.tituloModal="Registrar Hora";
                                   this.nombre="";
                                   this.descripcion="";
                                   this.tipoAccion=1;
                                   break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal2=1;
                                    this.tituloModal="Editar Taller";
                                    this.tipoAccion=2;
                                    this.taller_id=data["id"];
                                    this.nombre=data["nombre"];
                                    this.direccion=data["direccion"];
                                    this.color=data["color"];
                                    this.estado=data["estado"];
                                    break;
                                }
                        
                        }


                    }

                }

        },
        cerrarModal(){
            this.modal=0;
            this.nombre="";
            this.direccion="";
            this.color="",
            this.estado=0,
            this.tituloModal="";
        },
        cerrarModal2(){
            this.modal2=0;
            this.nombre="";
            this.direccion="";
            this.color="",
            this.estado=0,
            this.tituloModal="";
        },
      
      eventDisplay(event) {
      return (
        event.startTime.format("HH:mm") +
        "-" +
        event.endTime.format("HH:mm") +
        " " +
        event.name
      );
    },
    eventClicked(event) {
      this.eventSelected = event;
      this.showEventDialog = true;
      //this.events = [];
    },
    monthChanged(newDate) {
      this.mes = newDate.getMonth() + 1;
      this.cargarEventos(this.mes);
    },
    eventCreated(event) {
      let data = {
        fecha: moment(event.date).format("YYYY-MM-DD"),
        hora_inicio: event.startTime,
        hora_fin: event.endTime,
        motivo: event.name,
        taller_id: this.identificador_taller,
        user_id:this.id_cuenta
      };
      if (this.fechaPasado(event.date)) {
          this.$notify({
            group: "notificacion",
            title: "Reseva invalida",
            text: "No se puede realizar reservaciones <br> de una fecha pasada",
            type: "error"
          });
          this.cargarEventos(this.mes);
      } else {

      this.$notify({
        group: "notificacion",
        title: "Espere un momento",
        text: "Se esta reservando el taller  ....",
        type: "warn",
        duration: 5000
      });
        axios({
          method: "post",
          url: "/api/reserva",
          data: data,
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        })
          .then(res => {
                this.cargarEventos(this.mes);
              if(res.status == 202){
              this.$notify({
                group: "notificacion",
                title: "Reservacion Invalida",
                text: "El ambinete ya se encuentra <br>reservado en ese horario",
                type: "warn",
                duration: 10000
              });
            }else{
              this.$notify({
                group: "notificacion",
                title: "Taller Reservado",
                text: "Se reservo el taller exitosamente",
                type: "success",
                duration: 5000,
              });
            }
          })
          .catch(error => {
            console.log(error);
            this.cargarEventos(this.mes);
            this.$notify({
              group: "notificacion",
              title: "Error al reservar taller",
              text: "Ocurrio un error al reservar el taller",
              type: "error"
            });
          });
      }
    },
    cargarEventos(mes) {
      ///reserva/{id_ambiente}/ambiente/{$mes}/mes
      this.loading = true;
      //console.log('Usuario logeado',User.nameUser().id)
      axios
        .request({
          url: `/api/reserva/${this.taller_id}/taller/${mes}/mes`,
          method: "get",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        })
        .then(res => {
          this.loading = false;
          let events = res.data.data;
          this.events = events.map(function(object) {
            object.estilo =
              object.user_id == User.nameUser().id
                ? "v-cal-event-item-user"
                : "v-cal-event-item";
            return object;
          });

          //this.events = res.data.data;
        })
        .catch(error => {
          this.loading = false;
          console.log(error);
          alert('el error esl ' + error)
          // User.logout();
          // this.$bus.$emit("logged", "User logged");
          // this.$router.push({ path: "lista-talleres" });
        });
    },
    eventoBorradoDialog(value) {
      if (value) {
        this.$notify({
          group: "notificacion",
          title: "Reserva Eliminada",
          text: "La reserva se borro exitosamente",
          type: "success",
          duration: 5000,
        });
      } else {
        this.$notify({
          group: "notificacion",
          title: "Reserva sin eliminar",
          text: "No se pudo eliminar la reserva",
          type: "error"

        });
      }
      this.cargarEventos(this.mes);
    },
    fechaPasado(fecha) {
      let hoy = new Date();
      hoy.setHours(0, 0, 0, 0);
      return fecha < hoy;
    }
        
        },
        components: {
    EventDialog
  },

        mounted() {
            // console.log('Component mounted.')
            this.listarTaller();
          }
    }
</script>
<style>
    .modal-content{
        width: 100%!important;
        position: absolute!important;
    }
    .mostrar{
        display: list-item!important;
        opacity: 1!important;
        position: absolute!important;
        background-color:#3c29297a!important;
    }
    /* .text-error{
        color:red!important;
        font-weight: bold;
        font-size: 20px;
    } */
    .taller{
      margin: 5px 5px 5px 5px;
    }
</style>