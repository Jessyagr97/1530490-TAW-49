<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Categorías</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Productos</a></div>
                    <div class="breadcrumb-item">Categorías</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Administración de categorías</h2>
                <p class="section-lead">Módulo disponible solo para administradores. Agregue y edite categorías.</p>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabla categorías</h4>
                                <div class="card-header-form">
                                    <div class="input-group">
                                       <strong>buscar por: </strong>&nbsp;&nbsp;
                                       <select class="form-control-sm" v-model="criterio">
                                            <option value="nombre_categoria">Nombre</option>
                                            <option value="descripcion_categoria">Descripción</option>
                                        </select>&nbsp;&nbsp;
                                        <input v-model="buscar" @keyup.enter="listarCategoria(1, buscar, criterio);" type="text" class="form-control" placeholder="Buscar">
                                        <div class="input-group-btn">
                                            <button @click="listarCategoria(1, buscar, criterio);" class="btn btn-primary" style=""><i class="fas fa-search"></i></button>
                                        </div> 
                                        &nbsp;&nbsp;<button @click="abrirModal('categoria', 'registrar')" class="btn btn-primary btn-sm" sty><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>            
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
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                                <td v-text="categoria.nombre_categoria"></td>
                                                <td v-text="categoria.descripcion_categoria"></td>
                                                <td>
                                                    <div v-if="categoria.condicion">
                                                        <div class="badges">
                                                            <span class="badge badge-success">Activo</span>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="badges">
                                                            <span class="badge badge-danger">Desactivado</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                    <div class="buttons">
                                                        <a @click="abrirModal('categoria', 'actualizar', categoria)" href="#" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                        <template v-if="categoria.condicion">
                                                            <a @click="desactivarCategoria(categoria.id);" href="#" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="Borrado lógico"><i class="fas fa-ban"></i></a>
                                                        </template>
                                                        <template v-else>
                                                            <a @click="activarCategoria(categoria.id);" href="#" class="btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-power-off"></i></a>
                                                        </template>
                                                        <a @click="borrarCategoria(categoria.id);" href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="far fa-trash-alt"></i></a>
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
        </section>

        <!--MODAL REGISTRAR/ACTUALIZAR-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-text="tituloModal"></h5>
                        <button @click="cerrarModal();" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--CONTENIDO MODAL-->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre de categoría *</label>
                            <input v-model="nombre_categoria" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Descripción *</label>
                            <textarea v-model="descripcion_categoria" class="form-control"></textarea>
                        </div>
                        <div v-show="errorCategoria" class="form-group div-error">
                            <div class="text-error">
                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error"></div>
                            </div>
                        </div>
                    </div>
                    <!--FIN CONTENIDO-->
                    <!--BOTONES-->
                    <div class="modal-footer bg-whitesmoke br">
                        <div class="buttons">
                            <a @click="cerrarModal();" href="#" class="btn btn-icon icon-left btn-secondary">Cerrar</a>
                            <a v-if="tipoAccion==1" @click="registrarCategoria();" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
                            <a v-if="tipoAccion==2" @click="actualizarCategoria();"  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-sync-alt"></i> Actualizar</a>
                       </div>
                    </div>
                    <!--FIN BOTONES-->
                </div>
            </div>
        </div>
        <!--FIN MODAL-->

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
                categoria_id: 0,
                nombre_categoria : '',
                descripcion_categoria : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
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
                criterio : 'nombre_categoria',
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
            listarCategoria (page, buscar, criterio){
                let me = this;
                var url = '/categoria?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias.data; //Almacenar contenido del objeto response al array
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
                me.listarCategoria(page, buscar, criterio);
            },

            /*CREAR UN NUEVO REGISTRO*/
            registrarCategoria(){
                //Validacion de campos antes de realizar el registro
                if (this.validarCategoria()){
                    return;
                }

                let me = this;
                axios.post('/categoria/registrar', {
                    'nombre_categoria' : this.nombre_categoria,
                    'descripcion_categoria' : this.descripcion_categoria
                }).then(function (response) {
                    me.cerrarModal(); //Cerrar modal
                    me.listarCategoria(1, '', 'nombre_categoria');   //Volver a enlistar los registros
                    toastr["success"]("Registro guardado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            //EDITAR UN REGISTRO
            actualizarCategoria(){
                //Validacion de campos antes de realizar el registro
                if (this.validarCategoria()){
                    return;
                }

                let me = this;
                axios.put('/categoria/actualizar', {
                    'nombre_categoria' : this.nombre_categoria,
                    'descripcion_categoria' : this.descripcion_categoria,
                    'id' : this.categoria_id
                }).then(function (response) {
                    me.cerrarModal(); //Cerrar modal
                    me.listarCategoria(1, '', 'nombre_categoria');   //Volver a enlistar los registros
                    toastr["success"]("¡Registro actualizado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            
            /*BORRADO LOGICO*/
            desactivarCategoria(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado Lógico',
                    text: "La categoría será desactivada y no estará disponible para ningun usuario, así como los productos relacionados a esta categoría, ¿Desea continuar?.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/categoria/desactivar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarCategoria(1, '', 'nombre_categoria');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Dasactivada',
                        'La categoría ha sido desactivada.',
                        'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        
                    }
                    }) 
            },

            /*ACTIVADO LOGICO*/
            activarCategoria(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Acivación de categoría',
                    text: "La categoría será reactivada y volverá a estar disponible para los usuarios, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/categoria/activar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarCategoria(1, '', 'nombre_categoria');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Activada',
                        'La categoría ha sido reactivada.',
                        'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        
                    }
                    }) 
            },

            /*BORRADO PERMAMENTE*/
            borrarCategoria(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado permanente',
                    text: "El registro será eliminado de manera permanente, así como los productos relacionados a este, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/categoria/borrar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarCategoria(1, '', 'nombre_categoria');   //Volver a enlistar los registros
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
            validarCategoria(){
                this.errorCategoria = 0;
                this.errorMostrarMsjCategoria = [];

                if(!this.nombre_categoria) this.errorMostrarMsjCategoria.push("Ingrese el nombre de la categoría.");
                if(!this.descripcion_categoria) this.errorMostrarMsjCategoria.push("Ingrese una descripción.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },

            /*CERRAR EL MODAL*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre_categoria = '';
                this.descripcion_categoria = '';
                this.tipoAccion = 0;
            },

            /*ABRIR MODAL PARA REALIZAR UN REGISTRO O ACTUALIZAR*/
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria": {
                        switch(accion){
                            case "registrar": {
                                this.modal = 1;
                                this.tituloModal = "Registrar Categoría";
                                this.nombre_categoria = "";
                                this.descripcion_categoria = "";
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar": {
                                this.modal = 1;
                                this.categoria_id = data['id'];
                                this.tituloModal = "Actualizar Categoría";
                                this.nombre_categoria = data['nombre_categoria'];
                                this.descripcion_categoria = data['descripcion_categoria'];
                                this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarCategoria(1, this.buscar, this.criterio);
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