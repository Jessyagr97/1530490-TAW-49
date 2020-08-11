<template>
    <div class="main-content">

        <section class="section">

            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Perfil del usuario</h1>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">

                <h2 class="section-title">Administración del perfil del usuario</h2>
                <p class="section-lead">Módulo disponible para administradores y comerciantes. Agregue y edite información.</p>
                
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card profile-widget">
                            <a @click="editarImagen();" href="#"><i class="fas fa-pencil-alt"></i></a>
                            <div class="profile-widget-header" v-for="usuario in arrayUsuario" :key="usuario.id">
                                <img alt="Escoge una imagen" v-bind:src="rutaImg" class="rounded-circle profile-widget-picture">  
                                <div class="profile-widget-items" >
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Nombre</div>
                                        <div class="profile-widget-item-value">{{ usuario.nombre }}</div>
                                        </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Rol</div>
                                        <div class="profile-widget-item-value">{{ usuario.rol }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Tipo de cuenta</div>
                                        <div class="profile-widget-item-value">
                                            <div class="badges">
                                                &nbsp;&nbsp;<span class="badge badge-danger"><i class="fas fa-fire"></i> Premium</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                        <div class="card-header">
                            <h4>Información general</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Usuario</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Dirección</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Empresa</a>
                                    </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div v-for="usuario in arrayUsuario" :key="usuario.id" class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                            <div class="form-row">
                                                <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                                    <label>Nombre (s) *</label>
                                                    <input v-model="usuario.nombre" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Apellido Paterno *</label>
                                                    <input v-model="usuario.apellido_p" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Apellido Materno *</label>
                                                    <input v-model="usuario.apellido_m" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Correo electrónico *</label>
                                                    <input v-model="usuario.email" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Contraseña *</label>
                                                    <input v-model="password" type="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                                    <label>Telefono *</label>
                                                    <input v-model="usuario.telefono" class="form-control">
                                                </div>
                                            </div>

                                            <div v-show="errorCategoria" class="form-group div-error">
                                                <div class="text-error">
                                                    <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error"></div>
                                                </div>
                                            </div>

                                            <div class="buttons">
                                                <a  @click="actualizarUsuario(usuario.image_profile);" style="text-align: right;" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>País *</label>
                                                    <select class="form-control" >
                                                        <option value="0">Seleccione un rol</option>
                                                        <option ></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Estado *</label>
                                                    <select class="form-control" >
                                                        <option value="0">Seleccione un rol</option>
                                                        <option ></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>Ciudad *</label>
                                                    <input  class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                                    <label>C. P. *</label>
                                                    <input  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-5 col-sm-5 col-lg-5">
                                                    <label>Colonia *</label>
                                                    <input  class="form-control">
                                                </div>
                                                <div class="form-group col-md-5 col-sm-5 col-lg-5">
                                                    <label>Calle *</label>
                                                    <input  class="form-control">
                                                </div>
                                                <div class="form-group col-md-2 col-sm-2 col-lg-2">
                                                    <label>Número de casa *</label>
                                                    <input  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                                    <label>Descripción adicional *</label>
                                                    <input  class="form-control">
                                                </div>
                                            </div>
                                        
                                            <div  class="form-group div-error">
                                                <div class="text-error">
                                                    <div ></div>
                                                </div>
                                            </div>

                                            <div class="buttons">
                                                <a  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            
            </div>
            <!--FIN CONTENIDO-->

        </section>

        <!--MODAL IMAGENES-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mi galería</h5>
                        <button @click="cerrarImagenes();" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--CONTENIDO MODAL-->
                    <div class="modal-body">
                        <div v-for="imagen in arrayImagenes" :key="imagen.id" >
                            <center><a href="#"><img v-bind:src="imagen.ruta" width="65px" ></a>&nbsp;<a @click="actualizarUsuario(imagen.ruta);"  href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i></a>
                       </center><br>
                        </div>

                        <div v-show="errorCategoria" class="form-group div-error">
                            <div class="text-error">
                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error"></div>
                            </div>
                        </div>
                    </div>
                    <!--FIN CONTENIDO-->
                    <!--PAGINACION-->
                    <div class="card-footer bg-whitesmoke text-right">
                        <div class="form-group">
                            <center><label for="password">Ingrese su contraseña</label></center>
                            <input v-model="password" type="password" class="form-control">
                        </div>
                        <br>    
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
                arrayImagenes: [],
                rutaImg: '',

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
                criterio : '',
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
                var url = '/perfil';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.perfil.data; //Almacenar contenido del objeto response al array
                    me.rutaImg = me.arrayUsuario[0].image_profile;
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

            //EDITAR UN REGISTRO
            actualizarUsuario(ruta){
                //Validacion de campos antes de realizar el registro
                if (this.validarUsuario()){
                    return;
                }

                let me = this;
                
                me.rutaImg = ruta;
                axios.put('/usuario/actualizar', {
                    'nombre' : this.arrayUsuario[0].nombre,
                    'apellido_p' : this.arrayUsuario[0].apellido_p,
                    'apellido_m' : this.arrayUsuario[0].apellido_m,
                    'telefono' : this.arrayUsuario[0].telefono,
                    'email' : this.arrayUsuario[0].email,
                    'password' : this.password,
                    'image_profile': ruta,
                    'idrol' : this.arrayUsuario[0].idrol,
                    'id' : this.arrayUsuario[0].id
                }).then(function (response) {
                    me.cerrarImagenes();
                    me.listarUsuario(page, buscar, criterio);   //Volver a enlistar los registros
                    toastr["success"]("Perfil actualizado con éxito.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                //toastr["success"]("Perfil actualizado con éxito!.");
            },
            
            editarImagen(){
                this.modal = 1;
            },

            cerrarImagenes(){
                this.modal = 0;
                this.password = '';
            },

            /*VALIDACIONES DE CAMPOS*/
            validarUsuario(){
                this.errorCategoria = 0;
                this.errorMostrarMsjCategoria = [];

                if(!this.arrayUsuario[0].nombre) this.errorMostrarMsjCategoria.push("Ingrese su nombre.");
                if(!this.arrayUsuario[0].apellido_p) this.errorMostrarMsjCategoria.push("Ingrese su apellido paterno.");
                if(!this.arrayUsuario[0].apellido_m) this.errorMostrarMsjCategoria.push("Ingrese su apellido materno.");
                if(!this.arrayUsuario[0].telefono) this.errorMostrarMsjCategoria.push("Ingrese su teléfono.");
                if(!this.arrayUsuario[0].email) this.errorMostrarMsjCategoria.push("Ingrese su correo eletrónico.");
                if(!this.password) this.errorMostrarMsjCategoria.push("Ingrese una contraseña.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            }
        },
        mounted() {
            this.listarUsuario(this.page, this.buscar, this.criterio);
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