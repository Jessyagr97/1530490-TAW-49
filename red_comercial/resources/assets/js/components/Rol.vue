<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Roles</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Usuario</a></div>
                    <div class="breadcrumb-item">Roles</div>
                </div>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <h2 class="section-title">Visualización de roles.</h2>
                <p class="section-lead">Módulo disponible solo para adminsitradores.</p>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                         <div class="card">
                            <div class="card-header">
                                <h4>Tabla roles</h4>
                                <div class="card-header-form">
                                    <div class="input-group">
                                       <strong>buscar por: </strong>&nbsp;&nbsp;
                                       <select class="form-control-sm" v-model="criterio">
                                            <option value="rol">Nombre</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>&nbsp;&nbsp;
                                        <input v-model="buscar" @keyup.enter="listarRol(1, buscar, criterio);" type="text" class="form-control" placeholder="Buscar">
                                        <div class="input-group-btn">
                                            <button @click="listarRol(1, buscar, criterio);" class="btn btn-primary" style=""><i class="fas fa-search"></i></button>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="rol in arrayRol" :key="rol.id">
                                                <td v-text="rol.rol"></td>
                                                <td v-text="rol.descripcion"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--PAGINACION-->
                            <div class="card-footer text-right">
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
                rol_id: 0,
                rol : '',
                descripcion : '',
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,

                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 3,
                criterio : 'rol',
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
            listarRol (page, buscar, criterio){
                let me = this;
                var url = '/tipousuario?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.tipousuario.data; //Almacenar contenido del objeto response al array
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
                me.listarRol(page, buscar, criterio);
            }
        },
        mounted() {
            this.listarRol(1, this.buscar, this.criterio);
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