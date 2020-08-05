<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Usuarios</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Usuario</a></div>
                    <div class="breadcrumb-item">Listado de usuarios</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Administración de usuarios</h2>
                <p class="section-lead">Módulo disponible solo para administradores. Agregue y edite usuarios.</p>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                         <div class="card">
                            <div class="card-header">
                                <h4>Tabla usuarios</h4>
                                <div class="card-header-form">
                                    <div class="input-group">
                                       <strong>buscar por: </strong>&nbsp;&nbsp;
                                       <select class="form-control-sm" v-model="criterio">
                                            <option value="nombre">Nombre</option>
                                            <option value="email">Correo</option>
                                        </select>&nbsp;&nbsp;
                                        <input v-model="buscar" @keyup.enter="listarUsuario(1, buscar, criterio);" type="text" class="form-control" placeholder="Buscar">
                                        <div class="input-group-btn">
                                            <button @click="listarUsuario(1, buscar, criterio);" class="btn btn-primary" style=""><i class="fas fa-search"></i></button>
                                        </div> 
                                        &nbsp;&nbsp;<button @click="abrirModal('usuario', 'registrar')" class="btn btn-primary btn-sm" sty><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>            
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Teléfono</th>
                                                <th>Correo electrónico</th>
                                                <th>Rol</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="categoria in arrayUsuario" :key="categoria.id">
                                                <td v-text="categoria.nombre+' '+categoria.apellido_p+' '+categoria.apellido_m"></td>
                                                <td v-text="categoria.telefono"></td>
                                                <td v-text="categoria.email"></td>
                                                <td v-text="categoria.rol"></td>
                                                <!--<td>
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
                                                </td>-->
                                                <td> 
                                                    <div class="buttons">
                                                        <a @click="abrirModal('usuario', 'actualizar', categoria)" href="#" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                        <template v-if="categoria.condicion">
                                                            <a @click="desactivarUsuario(categoria.id);" href="#" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="Borrado lógico"><i class="fas fa-ban"></i></a>
                                                        </template>
                                                        <template v-else>
                                                            <a @click="activarUsuario(categoria.id);" href="#" class="btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-power-off"></i></a>
                                                        </template>
                                                        <a @click="borrarUsuario(categoria.id);" href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="far fa-trash-alt"></i></a>
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
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                <label>Nombre (s) *</label>
                                <input v-model="nombre" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Apellido Paterno *</label>
                                <input v-model="apellido_p" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Apellido Materno *</label>
                                <input v-model="apellido_m" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Correo electrónico *</label>
                                <input v-model="email" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Contraseña *</label>
                                <input v-model="password" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Telefono *</label>
                                <input v-model="telefono" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                <label>Rol *</label>
                                <select class="form-control" v-model="idrol">
                                    <option value="0">Seleccione un rol</option>
                                    <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.rol"></option>
                                </select>
                            </div>
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
                            <a v-if="tipoAccion==1" @click="registrarUsuario();" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
                            <a v-if="tipoAccion==2" @click="actualizarUsuario();"  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-sync-alt"></i> Actualizar</a>
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
                idrol: 0,
                usuario_id: 0,
                nombre : '',
                apellido_p : '',
                apellido_m : '',
                telefono : '',
                email : '',
                password : '',
                arrayUsuario : [],
                arrayRol : [],
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
                criterio : 'nombre',
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
            listarUsuario (page, buscar, criterio){
                let me = this;
                var url = '/usuario?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.users.data; //Almacenar contenido del objeto response al array
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            /*SELECCIONAR UN ROL*/
            selectRol(){
                let me = this;
                var url = '/tipousuario/selectRol';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles; //Almacenar contenido del objeto response al array
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
                me.listarUsuario(page, buscar, criterio);
            },

            /*CREAR UN NUEVO REGISTRO*/
            registrarUsuario(){
                //Validacion de campos antes de realizar el registro
                if (this.validarUsuario()){
                    return;
                }

                let me = this;
                axios.post('/usuario/registrar', {
                    'nombre' : this.nombre,
                    'apellido_p' : this.apellido_p,
                    'apellido_m' : this.apellido_m,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'password' : this.password,
                    'idrol' : this.idrol
                }).then(function (response) {
                    me.cerrarModal(); //Cerrar modal
                    me.listarUsuario(1, '', 'nombre');   //Volver a enlistar los registros
                    toastr["success"]("Registro guardado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            //EDITAR UN REGISTRO
            actualizarUsuario(){
                //Validacion de campos antes de realizar el registro
                if (this.validarUsuario()){
                    return;
                }

                let me = this;
                axios.put('/usuario/actualizar', {
                    'nombre' : this.nombre,
                    'apellido_p' : this.apellido_p,
                    'apellido_m' : this.apellido_m,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'password' : this.password,
                    'idrol' : this.idrol,
                    'id' : this.usuario_id
                }).then(function (response) {
                    me.cerrarModal(); //Cerrar modal
                    me.listarUsuario(1, '', 'nombre');   //Volver a enlistar los registros
                    toastr["success"]("Registro actualizado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            
            /*BORRADO LOGICO*/
            desactivarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado Lógico',
                    text: "El usuario será desactivado y no estará disponible, así como los productos relacionados a este usuario, ¿Desea continuar?.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/usuario/desactivar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarUsuario(1, '', 'nombre');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Dasactivado',
                        'El usuario ha sido desactivada.',
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
            activarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Acivación de usuario',
                    text: "El usuario será reactivada y volverá a estar disponible su sesión, así como sus registros, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/usuario/activar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarUsuario(1, '', 'nombre');   //Volver a enlistar los registros
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Activado',
                        'EL usuario ha sido reactivado.',
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
            borrarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Borrado permanente',
                    text: "El registro será eliminado de manera permanente, así como los registros relacionados a este, ¿Desea continuar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, deseo continuar.',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/usuario/borrar', {
                            'id' : id
                        }).then(function (response) {
                            me.cerrarModal(); //Cerrar modal
                            me.listarUsuario(1, '', 'nombre');   //Volver a enlistar los registros
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
            validarUsuario(){
                this.errorCategoria = 0;
                this.errorMostrarMsjCategoria = [];

                if(!this.nombre) this.errorMostrarMsjCategoria.push("Ingrese su nombre.");
                if(!this.apellido_p) this.errorMostrarMsjCategoria.push("Ingrese su apellido paterno.");
                if(!this.apellido_m) this.errorMostrarMsjCategoria.push("Ingrese su apellido materno.");
                if(!this.telefono) this.errorMostrarMsjCategoria.push("Ingrese su teléfono.");
                if(!this.email) this.errorMostrarMsjCategoria.push("Ingrese su correo eletrónico.");
                if(!this.password) this.errorMostrarMsjCategoria.push("Ingrese una contraseña.");
                if(this.idrol==0) this.errorMostrarMsjCategoria.push("Seleccione un rol para el usuario.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },

            /*CERRAR EL MODAL*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellido_p = '';
                this.apellido_m = '';
                this.telefono = '';
                this.email = '';
                this.password = '';
                this.idrol = 0;
                this.tipoAccion = 0;
            },

            /*ABRIR MODAL PARA REALIZAR UN REGISTRO O ACTUALIZAR*/
            abrirModal(modelo, accion, data = []){
                this.selectRol(); //Llamar esta funcion para desplegar los roles cuando se habra el modal
                switch(modelo){
                    case "usuario": {
                        switch(accion){
                            case "registrar": {
                                this.modal = 1;
                                this.tituloModal = "Registrar Usuario";
                                this.nombre = "";
                                this.apellido_p = "";
                                this.apellido_m = "";
                                this.telefono = "";
                                this.email = "";
                                this.password = "";
                                this.idrol = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar": {
                                this.modal = 1;
                                this.usuario_id = data['id'];
                                this.tituloModal = "Actualizar Usuario";
                                this.nombre = data["nombre"];
                                this.apellido_p = data["apellido_p"];
                                this.apellido_m = data["apellido_m"];
                                this.telefono = data["telefono"];
                                this.email = data["email"];
                                this.password = data["password"];
                                this.idrol = data["idrol"];
                                this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarUsuario(1, this.buscar, this.criterio);
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