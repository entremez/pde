    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bigModalPreview">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                
                
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Visualización del caso en los catalogos de casos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Visualización del caso en la página particular del caso</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container" style="width: 94%">
                <div class="col-md-10 offset-md-1">
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="service">
                            <div class="corner"></div>
                            <div class="image-container">
                                <div class="container"> 
                                    <div class="row-c">
                                        <div class="div2"></div>
                                        <div class="div1"></div>
                                    </div>
                                </div>       
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="service">
                            <div class="corner"></div>
                            <div class="image-container">
                                <div class="container"> 
                                    <div class="row-c">
                                        <div class="div2-grande"></div>
                                        <div class="div1-grande"></div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="mt-4">
                <div class="row">
                    <div class="col-md-9">
                        <img class="image-container preview w-100 image-case" >
                        <div class="middle-case">
                                <div class="text-case-preview"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img class="w-100 image-company">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <p class="text-muted">Caso de diseño en la industria</p>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-9">
                    <h3 class="name"></h3>
                    <p class="text-left font-italic mt-3 quote"></p>
                    <p class="description"></p>

                    
                    <div class="text-muted mt-5 mb-2 font-weight-bold">Etiquetas</div>
                    <div id="tags"></div>

                </div>
                <div class="col-md-3">
                    <p>Proveedor de diseño</p>
                    <div class="center-img">
                        <img class="w-100 h-100" id="image_logo_preview">
                    </div>
                    <a href="#!" class="btn btn-danger w-100 provider-btn">Ver proveedor de diseño</a>
                </div>
            </div>
          </div>
        </div>
        </div>



        <hr>

                <div class="row buttons-preview">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Editar</button>
                    <button id="submit-create-case" type="submit" class="btn btn-danger">Enviar caso</button>
                </div>
          </div>
        </div>
      </div>
    </div>