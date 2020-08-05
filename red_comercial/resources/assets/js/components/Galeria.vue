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
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <h1>Opciones</h1>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Default Tab</h4>
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
                                        <div class="gallery">
                                            <div class="gallery-item" data-image="assets/img/news/img01.jpg" data-title="Image 1" href="../assets/img/news/img01.jpg" title="Imagen 1" style="background-image: url(&quot;../assets/img/news/img01.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img02.jpg" data-title="Image 2" href="../assets/img/news/img02.jpg" title="Imagen 2" style="background-image: url(&quot;../assets/img/news/img02.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img03.jpg" data-title="Image 3" href="../assets/img/news/img03.jpg" title="Imagen 3" style="background-image: url(&quot;../assets/img/news/img03.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img04.jpg" data-title="Image 4" href="../assets/img/news/img04.jpg" title="Imagen 4" style="background-image: url(&quot;../assets/img/news/img04.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img05.jpg" data-title="Image 5" href="../assets/img/news/img05.jpg" title="Imagen 5" style="background-image: url(&quot;../assets/img/news/img05.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img06.jpg" data-title="Image 6" href="../assets/img/news/img06.jpg" title="Imagen 6" style="background-image: url(&quot;../assets/img/news/img06.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img07.jpg" data-title="Image 7" href="../assets/img/news/img07.jpg" title="Imagen 7" style="background-image: url(&quot;../assets/img/news/img07.jpg&quot;);"></div>
                                            <div class="gallery-item" data-image="assets/img/news/img08.jpg" data-title="Image 8" href="../assets/img/news/img08.jpg" title="Imagen 8" style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);"></div>
                                        </div>
                                        <!--PAGINACION-->
                                        <div class="card-footer text-right">
                                            <nav class="d-inline-block">
                                                <ul class="pagination mb-0">
                                                    <li class="page-item " >
                                                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                                    </li>
                                                    <li class="page-item " >
                                                        <a class="page-link" href="#"> <span class="sr-only">(current)</span></a>
                                                    </li>
                                                    <li class="page-item" >
                                                        <a  class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!--FIN PAGINACION-->
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form action="#" id="mydropzone">
                                            <div class="fallback">
                                                <center><input name="file" type="file" multiple=""></center>
                                            </div>
                                            <div class="dropzone">
                                                
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