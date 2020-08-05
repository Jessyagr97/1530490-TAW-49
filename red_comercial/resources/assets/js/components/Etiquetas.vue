<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Etiquetas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Productos</a></div>
                    <div class="breadcrumb-item">Etiquetas</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Administración de etiquetas</h2>
                <p class="section-lead">Módulo disponible para administradores y comerciantes. Agregue y edite categorías.</p>
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ tituloModal }} una etiqueta</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nombre de etiqueta *</label>
                                    <input v-model="nombre_etiqueta" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Descripción de etiqueta *</label>
                                    <textarea v-model="descripcion_etiqueta" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 60px;"></textarea>
                                </div>
                                <div v-show="errorCategoria" class="form-group div-error">
                                    <div class="text-error">
                                        <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-right">
                                <a v-if="btnCancelar==0" @click="cancelar();" style="margin-right: 1rem;" href="#" class="btn btn-icon icon-left btn-secondary disabled">Cancelar</a>
                                <a v-if="btnCancelar==1" @click="cancelar();" style="margin-right: 1rem;" href="#" class="btn btn-icon icon-left btn-dark">Cancelar</a>
                                <a v-if="tipoAccion==1" @click="registrarEtiqueta();" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
                                <a v-if="tipoAccion==2" @click="actualizarEtiqueta();"  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-sync-alt"></i> Actualizar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabla etiquetas</h4>
                                <div class="card-header-form">
                                    <div class="input-group">
                                       <strong>buscar por: </strong>&nbsp;&nbsp;
                                       <select class="form-control-sm" v-model="criterio">
                                            <option value="nombre_etiqueta">Nombre</option>
                                            <option value="descripcion_etiqueta">Descripción</option>
                                        </select>&nbsp;&nbsp;
                                        <input v-model="buscar" @keyup.enter="listarEtiqueta(1, buscar, criterio);" type="text" class="form-control" placeholder="Buscar">
                                        <div class="input-group-btn">
                                            <button @click="listarEtiqueta(1, buscar, criterio);" class="btn btn-primary" style=""><i class="fas fa-search"></i></button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="etiqueta in arrayEtiqueta" :key="etiqueta.id">
                                                <td v-text="etiqueta.nombre_etiqueta"></td>
                                                <td v-text="etiqueta.descripcion_etiqueta"></td>
                                                <td>
                                                    <div class="buttons">
                                                        <a @click="editarEtiqueta(etiqueta);" href="#" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                        <a @click="borrarEtiqueta(etiqueta.id);" href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                    </div>
                </div>
            </div>
            <!--FIN CONTENIDO-->

            <!--FOOTER-->
            <footer class="main-footer">
                <div class="footer-left">
                    2020 <div class="bullet"></div> Design By <a href="#">Jessica Aguirre</a>
                </div>
            </footer>
            <!--FIN FOOTER-->

        </section>
    </div>
</template>
<script>
    export default {
        data (){
            return {
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
                criterio : 'nombre_etiqueta',
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
            /*LISTAR DATOS*/
            listarEtiqueta (page, buscar, criterio){
                let me = this;
                var url = '/etiqueta?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEtiqueta = respuesta.etiquetas.data; //Almacenar contenido del objeto response al array
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
                me.listarEtiqueta(page, buscar, criterio);
            },

            /*CREAR UN NUEVO REGISTRO*/
            registrarEtiqueta(){
                //Validacion de campos antes de realizar el registro
                if (this.validarEtiqueta()){
                    return;
                }

                let me = this;
                axios.post('/etiqueta/registrar', {
                    'nombre_etiqueta' : this.nombre_etiqueta,
                    'descripcion_etiqueta' : this.descripcion_etiqueta
                }).then(function (response) {
                    me.cancelar();
                    me.listarEtiqueta(1, '', 'nombre_etiqueta');   //Volver a enlistar los registros
                    toastr["success"]("Registro guardado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            //EDITAR UN REGISTRO
            actualizarEtiqueta(){
                //Validacion de campos antes de realizar el registro
                if (this.validarEtiqueta()){
                    return;
                }

                let me = this;
                axios.put('/etiqueta/actualizar', {
                    'nombre_etiqueta' : this.nombre_etiqueta,
                    'descripcion_etiqueta' : this.descripcion_etiqueta,
                    'id' : this.etiqueta_id
                }).then(function (response) {
                    me.cancelar(); //Cerrar modal
                    me.listarEtiqueta(1, '', 'nombre_etiqueta');   //Volver a enlistar los registros
                    toastr["success"]("Registro actualizado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            /*BORRADO PERMAMENTE*/
            borrarEtiqueta(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado permanente',
                    text: "El registro será eliminado de manera permanente, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/etiqueta/borrar', {
                            'id' : id
                        }).then(function (response) {
                            me.cancelar(); //Cerrar modal
                            me.listarEtiqueta(1, '', 'nombre_etiqueta');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Eliminado',
                        'El registro se ha eliminado de manera permanente.',
                        'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        
                    }
                    }) 
            },

            /*VALIDACIONES DE CAMPOS*/
            validarEtiqueta(){
                this.errorCategoria = 0;
                this.errorMostrarMsjCategoria = [];

                if(!this.nombre_etiqueta) this.errorMostrarMsjCategoria.push("Ingrese el nombre de la etiqueta.");
                if(!this.descripcion_etiqueta) this.errorMostrarMsjCategoria.push("Ingrese una descripción.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },

            /*RESET DATOS*/
            cancelar(){
                this.modal = 0;
                this.tituloModal = 'Añadir';
                this.btnCancelar = 0;
                this.nombre_etiqueta = '';
                this.descripcion_etiqueta = '';
                this.etiqueta_id = 0;
                this.tipoAccion = 1;
            },

            /*ACTUALIZAR DATOS*/
            editarEtiqueta(data = []){
                this.modal = 1;
                this.btnCancelar = 1;
                this.tituloModal = 'Actualizar';
                this.nombre_etiqueta = data['nombre_etiqueta'];
                this.descripcion_etiqueta = data['descripcion_etiqueta'];
                this.etiqueta_id = data['id'];
                this.tipoAccion = 2;
            }
        },
        mounted() {
            this.listarEtiqueta(1, this.buscar, this.criterio);
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