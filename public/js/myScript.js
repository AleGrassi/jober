
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

function addSkillRequirementField(){
    var container = $("#skill_requirement_fields");
    var child = $(`<li class="list-group-item" id="skill_requirement_field">
                    <div class="row my-auto">
                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                            <input class="form-control" type="text" id="skill_requirement" name="skill_requirement[]" placeholder="Skill requirement...">
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

function addLanguageRequirementField(){
    var container = $("#language_requirement_fields");
    var child = $(`<li class="list-group-item" id="language_requirement_field">
                        <div class="row my-auto">
                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                <input class="form-control" type="text" id="language_requirement" name="language_requirement[]" placeholder="Language requirement...">
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
                                <input class="form-control mb-2" type="email" id="location_email" name="location_email[]" placeholder="Location email..." value="">
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

function computeAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function candidate(offer_id, worker_id){
    let success_msg = new Map();
    success_msg.set('it','Candidatura effettuata con successo!');
    success_msg.set('en','Application done succesfully!');
    let lang = $('body').attr('lang');

    $.ajax({
        url: '/application/candidate',
        type: 'GET',
        data: {
            offer: offer_id,
            worker: worker_id
        },
        success: function(data){
            if(data.done){
                $('#msg_error').hide();
                
                $('#msg_success_text').html(success_msg.get(lang));
                $('#msg_success').show();
            }
            
        }
    });
}

function checkApplication(offer_id, worker_id) {
    let error_msg = new Map();
    error_msg.set('it',"Ti sei gia' candidato per questa posizione");
    error_msg.set('en','You already applied for this position');
    let lang = $('body').attr('lang');

    $.ajax({
        url: '/application/check',
        type: 'GET',
        data: {offer: offer_id,
                worker: worker_id},
        success: function(data){    //data sono i dati che mi arrivano dalla richiesta, quelli in json
            if(data.found){ //il worker e' gia' candidato a questa offerta
                $('#msg_error_text').html(error_msg.get(lang));
                $('#msg_error').show();
                $('#msg_success').hide();
            }else{  //il worker non e' ancora candidato a questa offerta
                candidate(offer_id, worker_id);
            }
        }
    });
}

