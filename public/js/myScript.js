
function addDeleteFieldEffect(){
    $('.btn-delete-field').on('click', function (e) {
        $(this).closest("li").remove();        
    });   
}


function addEducationField(){
    var container = document.getElementById("education_fields");
    var children = container.children;
    
    child_index = children.length;

    var child = `<li class="list-group-item" id="education_field">
                                    <div class="row my-auto">
                                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                                            <input class="form-control" type="text" id="education" name="education[]" placeholder="School or university..." value="">
                                        </div> 
                                        <div class="col-12 col-sm-4 col-md-3 my-auto">
                                            <a class="btn btn-delete-field my-auto">
                                                <i class="bi bi-trash-fill"></i> 
                                            </a>
                                        </div>
                                    </div>
                            </li>`;

    container.innerHTML += child; 
    addDeleteFieldEffect();
}

function addFormerJobField(){
    var container = document.getElementById("former_job_fields");
    
    var code = `<li class="list-group-item">
                                    <div class="row my-auto">
                                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                                            <input class="form-control" type="text" id="former_job" name="former_job[]" placeholder="Former Job..." value="">
                                        </div> 
                                        <div class="col-12 col-sm-4 col-md-3 my-auto">
                                            <a class="btn btn-delete-field">
                                                <i class="bi bi-trash-fill"></i> 
                                            </a>
                                        </div>
                                    </div>
                            </li>`;
    
    container.insertAdjacentHTML("beforeend", code);
}

function addSkillField(){
    var container = document.getElementById("skill_fields");
    
    var code = `<li class="list-group-item">
                                    <div class="row my-auto">
                                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                                            <input class="form-control" type="text" id="skill" name="skill[]" placeholder="Skill..." value="">
                                        </div> 
                                        <div class="col-12 col-sm-4 col-md-3 my-auto">
                                            <a class="btn btn-delete-field">
                                                <i class="bi bi-trash-fill"></i> 
                                            </a>
                                        </div>
                                    </div>
                            </li>`;
    
    container.insertAdjacentHTML("beforeend", code);
}

function addLanguageField(){
    var container = document.getElementById("language_fields");
    
    var code = `<li class="list-group-item">
                                    <div class="row my-auto">
                                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                                            <input class="form-control" type="text" id="language" name="language[]" placeholder="Language..." value="">
                                        </div> 
                                        <div class="col-12 col-sm-4 col-md-3 my-auto">
                                            <a class="btn btn-delete-field">
                                                <i class="bi bi-trash-fill"></i> 
                                            </a>
                                        </div>
                                    </div>
                            </li>`;
    
    container.insertAdjacentHTML("beforeend", code);
}
