
// Edit Worker

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

function showImage (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Edit Company

function addLocationField(){
    var container = $("#location_fields");
    var child = $(`<li class="list-group-item" id="location_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control mb-2" type="text" id="location_name" name="location_name[]" placeholder="Location..." value="">
                                <input class="form-control mb-2" type="text" id="location_email" name="location_email[]" placeholder="Location email..." value="">
                                <input class="form-control mb-2 mb-sm-0" type="text" id="location_phone" name="location_phone[]" placeholder="Location phone number..." value="">
                            </div> 
                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                    <i class="bi bi-trash-fill"></i> 
                                </a>
                            </div>
                        </div>
                    </li>`);

    container.append(child);
}