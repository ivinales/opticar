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
                             <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <v-card>
          <v-card-title>
          Reparaciones Pendientes
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Buscador"
          single-line
          hide-details
        ></v-text-field>
          </v-card-title>
          <v-data-table :headers="headers" :items="reparaciones" :search="search" class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.id }}</td>
            <td>{{ props.item.rut_cliente }}</td>
            <td>{{ props.item.patente_vehiculo }}</td>
            <td class="layout px-0">
              <v-icon small class="mr-2" @click="editItem(props.item.id)">edit</v-icon>
            </td>
          </template>
        </v-data-table>
        </v-card>
        
      </div>
    </div>
    <div>
      <v-dialog v-model="dialog" max-width="1000px">
        <v-card>
          <v-card-title>
            <span class="headline">Detalle de la reparacion</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-card-text>
                <v-container grid-list-md>
                  <v-data-table :headers="headers2" :items="resultado" class="elevation-1">
                    <template v-slot:items="props2">
                      <td>{{ props2.item.repuesto }}</td>
                      <td>{{ props2.item.mantencion }}</td>
                      <td>{{ props2.item.observacion }}</td>
                      <td>
                        <v-select
                          item-text="label"
                          item-value="value"
                          v-model="props2.item.estado"
                          :items="estado"
                          label="Estado"
                          @change="actualizar(props2.item.estado,props2.item.id)"
                        ></v-select>
                      </td>
                    </template>
                    <template v-slot:no-data></template>
                  </v-data-table>
                </v-container>
              </v-card-text>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="dialog=false">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
         </main>
 
</template>

<script>
export default {
   props: ['rut','tipo_cuenta'],
  data: () => ({
    dialog: false,
    headers: [
      { text: "ID", value: "id" },
      { text: "Rut", value: "rut_cliente" },
      { text: "Patente", value: "patente_vehiculo" }
    ],
    headers2: [
      { text: "REPUESTO", value: "repuesto" },
      { text: "MANTENCION", value: "mantencion" },
      { text: "OBSERVACION", value: "observacion" }
    ],
    estado: [
      {
        label: "Reposo",
        value: "Reposo"
      },
      {
        label: "Mantenimiento",
        value: "Mantenimiento"
      },
      {
        label: "Finalizado",
        value: "Finalizado"
      }
    ],
    editedItem: {
      rut: "",
      name: "",
      Snombre: "",
      Papellido: "",
      Sapellido: "",
      fono: "",
      email: "",
      password: "",
      email: ""
    },
    reparaciones: [],
    resultado: [],
    estadopaso:{
        estado:""
    },
     search: '',
  }),
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    if (this.tipo_cuenta==2) {
      this.getReparaciones(1,"","");
    }
    if ( this.tipo_cuenta==3) {
      this.getReparaciones(1,this.rut,"rut_cliente");
    }
    
  },
  methods: {
    getReparaciones(page,buscar,criterio) {
       let me=this;

               var url= '/reparacion?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;
               axios.get(url).then(function (response) {
                    
                    me.reparaciones=response.data;

                })
                .catch(function (error) {
                    
                    console.log(error);
                });
    },
    editItem(id) {
      this.dialog = true;
      axios
        .request({
          url: `/reparacion/detallereparacion/${id}`,
          method: "get"
        })
        .then(res => {
          this.resultado = res.data.data;
          if (this.resultado) {
          } else {
            console.log("negativo");
          }
        })
        .catch(error => {
          console.log(error);
          alert(error);
        });
    },
      actualizar(event,id) {
          this.estadopaso.estado=event;
      axios
        .put(`/reparacion/estado/${id}`, this.estadopaso)
        .then(res => {
          //User.resposeAfterLogin(res)
        //   this.initialize();
        //   this.dialog = false;
        })
        .catch(error => {
          console.log(error)
          this.errors = error.response.data.errors;
        });
    },
    
  }
};
</script>
<style>
.application{
  width: 100%!important;
}
</style>

