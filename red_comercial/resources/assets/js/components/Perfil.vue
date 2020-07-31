<template>
    <div class="main-content">

        <section class="section">

            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Pérfil del usuario</h1>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">

                <h2 class="section-title">Administración del perfil del usuario</h2>
                <p class="section-lead">Módulo disponible para Administradores y Comerciantes. Agregue y edite información.</p>
                
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items" v-for="usuario in arrayUsuario" :key="usuario.id">
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
                                                <a  @click="actualizarUsuario();" style="text-align: right;" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Guardar</a>
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
            listarUsuario (){
                let me = this;
                var url = '/perfil';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.perfil.data; //Almacenar contenido del objeto response al array
                    me.pagination = respuesta.pagination;
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
                    'nombre' : this.arrayUsuario[0].nombre,
                    'apellido_p' : this.arrayUsuario[0].apellido_p,
                    'apellido_m' : this.arrayUsuario[0].apellido_m,
                    'telefono' : this.arrayUsuario[0].telefono,
                    'email' : this.arrayUsuario[0].email,
                    'password' : this.password,
                    'idrol' : this.arrayUsuario[0].idrol,
                    'id' : this.arrayUsuario[0].id
                }).then(function (response) {
                    
                    me.password = '';
                    me.listarUsuario();   //Volver a enlistar los registros
                    toastr["success"]("Perfil actualizado con éxito!.");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                //toastr["success"]("Perfil actualizado con éxito!.");
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
            this.listarUsuario();
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