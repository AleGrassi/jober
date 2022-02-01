
function addDeleteFieldEffect(elm){
    $(elm).closest("li").remove();        
}

function addEducationField(){
    var container = $("#education_fields");
    var child = $(`<li class="list-group-item" id="education_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control" type="text" id="education" name="education[]" placeholder="School or university...">
                            </div> 
                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                <a class="btn btn-delete-field my-auto" onclick="addDeleteFieldEffect(this)">
                                    <i class="bi bi-trash-fill"></i> 
                                </a>
                            </div>
                        </div>
                    </li>`);

    container.append(child);
}

function addFormerJobField(){
    var container = $("#former_job_fields");
    var child = $(`<li class="list-group-item" id="former_job_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control" type="text" id="former_job" name="former_job[]" placeholder="former job...">
                            </div> 
                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                <a class="btn btn-delete-field my-auto" onclick="addDeleteFieldEffect(this)">
                                    <i class="bi bi-trash-fill"></i> 
                                </a>
                            </div>
                        </div>
                    </li>`);

    container.append(child);
}

function addSkillField(){
    var container = $("#skill_fields");
    var child = $(`<li class="list-group-item" id="skill_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control" type="text" id="skill" name="skill[]" placeholder="skill...">
                            </div> 
                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                <a class="btn btn-delete-field my-auto" onclick="addDeleteFieldEffect(this)">
                                    <i class="bi bi-trash-fill"></i> 
                                </a>
                            </div>
                        </div>
                    </li>`);

    container.append(child);
}

function addLanguageField(){
    var container = $("#language_fields");
    var child = $(`<li class="list-group-item" id="language_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control" type="text" id="language" name="language[]" placeholder="language...">
                            </div> 
                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                <a class="btn btn-delete-field my-auto" onclick="addDeleteFieldEffect(this)">
                                    <i class="bi bi-trash-fill"></i> 
                                </a>
                            </div>
                        </div>
                    </li>`);

    container.append(child);
}
