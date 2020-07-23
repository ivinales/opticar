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

                       <h2>Listado de Soluciones</h2><br/>
                      
                    </div>
                  <div class="container fluid grid-list-lg">
                    <div class="row wrap">
                      <div class="xs12 md3 " >
                      <div class="card taller" style="width: 18rem;">
                      <div class="card-body" v-if="this.nodo">
                          <h5 class="card-title">Seleccione un NODO</h5>
                            <div class="form-check" v-for="mapa in listaMapa" :key="mapa.id">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" @click="seleccionarArbol(mapa)">
                            <label class="form-check-label" for="exampleRadios1" v-text="mapa.pregunta">
                                Default radio
                            </label>
                            </div>
                      
                         </div>
                      <div class="card-body" v-else>
                         <div v-if="contenido[0].pregunta">
                        <h1>{{contenido[0].pregunta}}</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" @click="seleccionarCamino(contenido[0].nleft)">
                            <label class="form-check-label" for="exampleRadios1">
                                Si
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" @click="seleccionarCamino(contenido[0].nright)">
                            <label class="form-check-label" for="exampleRadios2" >
                                No
                            </label>
                            </div>
                         </div>
                         <div v-else>
                        <h1>{{contenido[0].resultado}}</h1>
                            <div class="text-center">
                                 <button class="btn btn-primary btn-lg" type="button" @click="recargar()">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Reiniciar
                        </button>
                            </div>
                         </div>
                      </div>
                    </div>
                      </div>
                    
                    </div>
                    

                    
                </div>
                <!-- Fin ejemplo de tabla Listado -->
                  </div>

            </div>
         
        </main>
</template>

<script>

    export default {
        data(){
    return{
        listaMapa:null,
        contenido:null,
        nodo:true,
        offset:3,
        
    }
},
        computed: {
        },
    
       
        

        methods:{
        obtenerMapa(){
    
            
            let me =this;
            axios.get('/mapa',{
                
            })
            .then(function (response) {
                // handle success
                // console.log(response);
          me.listaMapa = response.data;
               
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },
        seleccionarArbol(mapa) {
            let me =this;

            this.nodo=false;

        axios
          .request({
            url: `/mapa/busqueda/${mapa.nleft}`,
            method: "get"
          })
          .then(res => {
            me.contenido = res.data;
              console.log("si")

            
          })
          .catch(error => {
            console.log(error);
          });
        
        },
        seleccionarCamino(id) {
            let me =this;

      (this.prueba = false),
        // console.log('nleft es : ',mapa.nleft)
        axios
          .request({
            url: `/mapa/busqueda/${id}`,
            method: "get"
          })
          .then(res => {
            me.contenido = res.data;
          })
          .catch(error => {
            console.log(error);
          });
    },
    recargar(){
          window.location.reload()
          console.log('recargando....')

    }
       
        },
        mounted() {
            // console.log('Component mounted.')
            this.obtenerMapa();
        }
    }
</script>
