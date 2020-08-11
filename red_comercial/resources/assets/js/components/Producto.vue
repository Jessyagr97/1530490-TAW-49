<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Listado de productos</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Productos</a></div>
                    <div class="breadcrumb-item">listado de productos</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Administración de productos</h2>
                <p class="section-lead">Módulo disponible para administradores y comerciantes. Agregue y edite sus productos.</p>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabla productos</h4>
                                <div class="card-header-form">
                                    <div class="input-group">
                                       <strong>buscar por: </strong>&nbsp;&nbsp;
                                       <select class="form-control-sm" v-model="criterio">
                                            <option value="nombre_producto">Nombre</option>
                                            <option value="descripcion_producto">Descripción</option>
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
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Empresa</th>
                                                <th>Categoria</th>
                                                <th>Etiquetas</th>
                                                <th>Stock</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                                <td><img v-bind:src="categoria.imagen_producto" alt="" width="50px"></td>
                                                <td v-text="categoria.nombre_producto"></td>
                                                <td v-text="categoria.descripcion_producto"></td>
                                                <td v-text="categoria.nombre_empresa"></td>
                                                <td v-text="categoria.nombre_categoria"></td>
                                                <th>..</th>
                                                <td v-text="categoria.stock"></td>
                                                <td>
                                                    <div v-if="categoria.condicion">
                                                        <div class="badges">
                                                            <span class="badge badge-success">En venta</span>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="badges">
                                                            <span class="badge badge-danger">Deshabilitado</span>
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
                        <div v-for="imagen in arrayImagenes" :key="imagen.id" >
                            <center><a href="#"><img v-bind:src="imagen.ruta" width="65px" ></a>&nbsp;<a @click="actualizarUsuario(imagen.ruta);"  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i></a>
                            </center><br>
                        </div>
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
                nombre_producto : '',
                descripcion_producto: '',
                stock: 0,
                imagen_producto: '',
                precio: 0,
                id_categoria: 0,
                id_empresa: 0,
                arrayImagenes: [],


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
                criterio : 'nombre_producto',
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
                var url = '/producto?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.productos.data; //Almacenar contenido del objeto response al array
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                //ENLISTAR IMAGENES
                var urli = '/galeria?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(urli).then(function (response) {
                    var respuestaI = response.data;
                    me.arrayImagenes = respuestaI.galeria.data; //Almacenar contenido del objeto response al array
                    me.pagination = respuestaI.pagination;
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
                    'nombre_producto' : this.nombre_producto,
                    'descripcion_producto' : this.descripcion_producto,
                    'stock': this.stock,
                    'precio': this.precio,
                    'imagen_producto': this,imagen_producto,
                    'idcategoria': this.id_categoria,
                    'idempresa': this.id_empresa
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
                axios.put('/producto/actualizar', {
                    'nombre_producto' : this.nombre_producto,
                    'descripcion_producto' : this.descripcion_producto,
                    'stock': this.stock,
                    'precio': this.precio,
                    'imagen_producto': this,imagen_producto,
                    'idcategoria': this.id_categoria,
                    'idempresa': this.id_empresa,
                    'id': id
                }).then(function (response) {
                    me.cerrarModal(); //Cerrar modal
                    me.listarCategoria(1, '', 'nombre_producto');   //Volver a enlistar los registros
                    toastr["success"]("¡Registro actualizado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
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
                        axios.put('/producto/borrar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarCategoria(1, '', 'nombre_producto');   //Volver a enlistar los registros
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

                if(!this.nombre_producto) this.errorMostrarMsjCategoria.push("Ingrese el nombre del producto.");
                if(!this.descripcion_producto) this.errorMostrarMsjCategoria.push("Ingrese una descripción.");
                if(!this.stock) this.errorMostrarMsjCategoria.push("Ingrese una cantidad de inventario");
                if(!this.precio) this.errorMostrarMsjCategoria.push("Ingrese un precio.");
                if(!this.imagen_producto) this.errorMostrarMsjCategoria.push("Escoga una imagen de la galería.");
                if(this.this.id_categoria==0) this.errorMostrarMsjCategoria.push("Escoga una categoría.");
                if(this.this.id_empresa==0) this.errorMostrarMsjCategoria.push("Escoga una empresa.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },

            /*CERRAR EL MODAL*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre_producto = '';
                this.descripcion_producto = '';
                this.stock = 0;
                this.precio = 0;
                this.imagen_producto = '';
                this.id_categoria = 0;
                this.id_empresa = 0;
                this.tipoAccion = 0;
            },

            /*ABRIR MODAL PARA REALIZAR UN REGISTRO O ACTUALIZAR*/
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria": {
                        switch(accion){
                            case "registrar": {
                                this.modal = 1;
                                this.tituloModal = "Registrar Producto";
                                this.nombre_producto = "";
                                this.descripcion_producto = "";
                                this.stock = 0;
                                this.precio =0;
                                this.id_empresa = 0;
                                this.id_categoria = 0;
                                this.imagen_producto = "";
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar": {
                                this.modal = 1;
                                this.categoria_id = data['id'];
                                this.tituloModal = "Actualizar Categoría";
                                this.nombre_producto = data['nombre_categoria'];
                                this.descripcion_producto = data['descripcion_categoria'];
                                this.stock = data['stock'];
                                this.precio = data['precio'];
                                this.id_empresa = data['id_empresa'];
                                this.id_categoria = data['id_categoria'];
                                this.imagen_producto = data['imagen_producto'];
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