<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Galería</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Medios</a></div>
                    <div class="breadcrumb-item">Galería</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Administración de imagenes</h2>
                <p class="section-lead">Módulo disponible para administradores y comerciantes. Agregue y edite sus imagenes.</p>
            
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Mi galería</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mis imagenes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Subir imagen</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <!--<div class="gallery" v-for="imagen in arrayImages" :key="imagen.id">
                                            <div class="gallery-item" v-bind:data-image="imagen.ruta" v-bind:data-title="imagen.id" v-bind:href="imagen.ruta" v-bind:title="imagen.id" v-bind:style="{'background-image': 'url(&quot;'+imagen.ruta+'&quot;)'}"></div>
                                        </div>-->
                                        <div class="card">
                                            <div class="card-body p-0" v-for="imagen in arrayImages" :key="imagen.id" >
                                                <center><a href="#"><img v-bind:src="imagen.ruta" width="100px" ></a>&nbsp;<a @click="borrarImagen(imagen.id, imagen.ruta)" href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="far fa-trash-alt"></i></a>
                            </center><br>
                                            </div>
                                        </div>
                                        <!--PAGINACION-->
                                        <div class="card-footer bg-whitesmoke text-right">
                                            <nav class="d-inline-block">
                                                <ul class="pagination mb-0">
                                                    <li class="page-item " v-if="pagination.current_page > 1">
                                                        <a @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio);" class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                                    </li>
                                                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio);" v-text="page"> <span class="sr-only">(current)</span></a>
                                                    </li>
                                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                        <a @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio);" class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!--FIN PAGINACION-->
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form action="#" id="mydropzone" enctype="multipart/form-data">
                                            <div class="fallback">
                                                <center><input @change="previewImage" name="imagen_nueva" type="file" multiple=""></center>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-lg-6">
                                                    <a v-if="checkSubida == 1" @click="cancelar();" href="#" class=""><i class="fas fa-times"></i></a>
                                                    <div class="dropzone">
                                                        <img width="400px" v-if="image_upload" :src="image_upload" />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-12 col-lg-6">
                                                    <h6>Nombre:</h6><div class="bg-whitesmoke"><div v-if="arrayImageUpload.name" v-text="arrayImageUpload.name"></div></div>
                                                    <br><h6>Tamaño:</h6><div class="bg-whitesmoke"><div v-if="arrayImageUpload.size" v-text="arrayImageUpload.size/1000+' Kb'"></div></div>
                                                    <br><h6>Tipo:</h6><div class="bg-whitesmoke"><div v-if="arrayImageUpload.type" v-text="arrayImageUpload.type"></div></div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card-footer bg-whitesmoke">
                                                <center><a v-if="checkSubida == 0" @click="subirImagen();" href="#" class="btn btn-icon icon-left btn-success disabled"><i class="fas fa-upload"></i> Subir</a></center>
                                                <center><a v-if="checkSubida == 1" @click="subirImagen();" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-upload"></i> Subir</a></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN CONTENIDO-->
        </section>

        <!--FOOTER-->
        <footer class="main-footer">
            <div class="footer-left">
                2020 <div class="bullet"></div> Design By <a href="#">Jessica Aguirre</a>
            </div>
        </footer>
        <!--FIN FOOTER-->
    </div>
</template>
<script>
    export default {
        data (){
            return {

                image_upload: '',
                arrayImageUpload: [],
                img: '',
                checkSubida: 0,

                arrayImages: [],
                imagen_id: 0,


                etiqueta_id: 0,
                nombre_etiqueta : '',
                descripcion_etiqueta : '',
                arrayEtiqueta : [],
                modal : 0,
                tituloModal : 'Añadir',
                tipoAccion : 1,
                btnCancelar : 0,
                errorCategoria: 0,
                errorMostrarMsjCategoria : [],

                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 3,
                criterio : 'ruta',
                buscar : ''
            }
        },
        computed : {
            isActived: function(){
                return this.pagination.current_page;
            },


            /*CALCULAR EL NUMERO DE PAGINAS*/
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pageArray = [];
                while(from <= to) {
                    pageArray.push(from);
                    from++;
                }

                return pageArray;
            }
        },
        methods : {

            
            /*VISIUALIZAR IMAGEN ANTES DE SUBIR*/
            previewImage(e){
                const file = e.target.files[0];
                this.img = file;
                console.log(this.img);
                this.image_upload = URL.createObjectURL(file);
                this.arrayImageUpload = file;
                this.checkSubida = 1;
            },

            /*SUBIR IMAGEN*/
            subirImagen(){
                let me = this;
                
                let formData = new FormData();
                formData.append('imagen', this.img);

                axios.post('/galeria/subir', formData).then(function (response) {
                    me.cancelar(); //Cerrar modal
                    me.listarImagenes(1, '', '');   //Volver a enlistar los registros
                    toastr["success"]("Imagen guardada con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            /*MOSTRAR IMAGENS*/
            listarImagenes(page, buscar, criterio){
                let me = this;
                var url = '/galeria?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayImages = respuesta.galeria.data; //Almacenar contenido del objeto response al array
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            /*CAMBIO DE PAGINA*/
            cambiarPagina(page, buscar, criterio){
                let me = this;

                //Actualizacion de la pagina
                me.pagination.current_page = page;
                //Enviar peticion para visualizar el contenido de la pagina
                me.listarImagenes(page, buscar, criterio);
            },

            /*BORRADO PERMAMENTE*/
            borrarImagen(id, ruta){

                let ruta_S = 'app/public/'+ruta.substr(9,(ruta.length-1));

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado permanente',
                    text: "La imagen será eliminada de manera permanente, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/galeria/borrar', {
                            'id' : id,
                            'ruta' : ruta_S
                        }).then(function (response) {
                            me.cancelar(); //Cerrar modal
                            me.listarImagenes(1, '', '');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Eliminado',
                        'Imagen eliminada de manera permanente.',
                        'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        
                    }
                    }) 
            },

            /*RESET DATOS*/
            cancelar(){
                this.image_upload = '';
                this.arrayImageUpload = [];
                this.img = '';
                this.checkSubida = 0;
            }
        },
        mounted() {
            this.listarImagenes(this.page, this.buscar, this.criterio);
        }
    }
    
</script>
<style>
    .modal-content {
        margin-top: 10%;
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
        height: 100% !important;
    }
    .div-error {
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>