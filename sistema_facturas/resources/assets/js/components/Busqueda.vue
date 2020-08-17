<template>
    <div class="main-content">
        <section class="section">
            <!--HEADER DE MODULO-->
            <div class="section-header">
                <h1>Consulta tu factura</h1>
            </div>
            <!--FIN HEADER DE MODULO-->

            <!--CONTENIDO-->
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body p-0">

                                <div class="input-group">
                                    <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                        <label>Sociedad emisora *</label>
                                        <select class="form-control" v-model="idsociedad">
                                            <option value="0">Seleccione una sociedad</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-group col-md-6 col-sm-12 col-lg-6">
                                        <label>R.F.C. receptor *</label>
                                        <input v-model="rfc_receptor" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-lg-6">
                                        <label>Razón social *</label>
                                        <input v-model="razon" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                        <label>Folio (opcional) *</label>
                                        <input v-model="folio" class="form-control" >
                                    </div>
                                </div>

                                <div v-show="errorCategoria" class="form-group div-error">
                                    <div class="text-error">
                                        <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error"></div>
                                    </div>
                                </div>

                                <!--BOTONES-->
                                <div class="modal-footer bg-whitesmoke br">
                                    <div class="buttons">
                                        <a @click="listarUsuario(1, idsociedad, rfc_receptor, razon, folio);" href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-search"></i> Buscar</a>
                                    </div>
                                </div>
                                <!--FIN BOTONES-->
                                  

                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Sociedad Emisora</th>
                                                <th>Razón Social</th>
                                                <th>R.F.C Receptor</th>
                                                <th>Folio</th>
                                                <th>Archivos disponibles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="categoria in arrayUsuario" :key="categoria.id">
                                                <td v-text="categoria.nombre"></td>
                                                <td v-text="categoria.razon"></td>
                                                <td v-text="categoria.rfc_receptor"></td>
                                                <td v-text="categoria.folio"></td>
                                                <td>
                                                    <div>
                                                        <a download v-bind:href="categoria.doc_pdf" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-file-pdf"></i> Descargar PDF</a>
                                                        
                                                        
                                                        <a v-if="categoria.doc_xml != ''" download v-bind:href="categoria.doc_xml" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="fas fa-file-excel"></i> Descargar XML</a>
                                                        <a v-if="categoria.doc_xml == ''" download href="#" class="btn btn-icon btn-success disabled" data-toggle="tooltip" data-placement="top" title="Borrado permanente"><i class="fas fa-file-excel"></i> No disponible</a>
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
                                            <a @click.prevent="cambiarPagina(pagination.current_page - 1, page, idsociedad, razon, folio);" class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page, page, idsociedad, razon, folio);" v-text="page"> <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a @click.prevent="cambiarPagina(pagination.current_page + 1, page, idsociedad, razon, folio);" class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
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

    </div>
</template>

<script>
    export default {
        data (){
            return {
                idrol: 0,
                usuario_id: 0,
                idsociedad: 0,
                razon : '',
                rfc_receptor : '',
                folio : '',
                pdf: '',
                xml: '',
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
                criterio : 'razon',
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
            listarUsuario (page, idsociedad, rfc_receptor, razon, folio){
                if (this.validarUsuario()){
                    return;
                }

                let me = this;
                var url = '/busqueda?page='+page+'&idsociedad='+idsociedad+'&rfc_receptor='+rfc_receptor+'&razon='+razon+'&folio='+folio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.facturas.data; //Almacenar contenido del objeto response al array
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
                var url = '/sociedad/selectSociedadP';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.sociedades; //Almacenar contenido del objeto response al array
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            /*CAMBIO DE PAGINA*/
            cambiarPagina(page, idsociedad, razon, folio){
                let me = this;

                //Actualizacion de la pagina
                me.pagination.current_page = page;
                //Enviar peticion para visualizar el contenido de la pagina
                me.listarUsuario(page, idsociedad, razon, folio);
            },

            /*VALIDACIONES DE CAMPOS*/
            validarUsuario(){
                this.errorCategoria = 0;
                this.errorMostrarMsjCategoria = [];

                if(!this.razon) this.errorMostrarMsjCategoria.push("Ingrese la razón social.");
                if(!this.rfc_receptor) this.errorMostrarMsjCategoria.push("Ingrese su R.F.C.");
                if(this.idsociedad==0) this.errorMostrarMsjCategoria.push("Seleccione una sociedad.");
            
                if(this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            }

        },
        mounted() {
           this.selectRol();
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