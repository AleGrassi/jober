
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

function candidate(offer_id, worker_id, uncandidate_string){
    let success_msg = new Map();
    success_msg.set('it','Candidatura effettuata con successo!');
    success_msg.set('en','Application done succesfully!');
    uncandidate_string = new Map();
    uncandidate_string.set('it','Annulla candidatura');
    uncandidate_string.set('en','Remove candidation');
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
                $('#msg_success_text').html(success_msg.get(lang));
                $('#msg_success').show();
                $('#candidate_btn').unbind('click');
                $('#candidate_btn').click(function(){
                    removeApplication(offer_id,worker_id);
                });
                $('#candidate_btn').html(uncandidate_string.get(lang));
            }
        }
    });
}

function checkApplication(offer_id, worker_id) {
    $.ajax({
        url: '/application/check',
        type: 'GET',
        data: {offer: offer_id,
                worker: worker_id},
        success: function(data){    //data sono i dati che mi arrivano dalla richiesta, quelli in json
            if(data.found){ //il worker e' gia' candidato a questa offerta
                //in questo caso il bottone che si deve vedere e' quello per rimuovere la candidatura
                $('#candidate').hide();
                $('#uncandidate').show();
            }else{  //il worker non e' ancora candidato a questa offerta
                //in questo caso il bottone che si deve vedere e' quello per candidarsi
                $('#uncandidate').hide();
                $('#candidate').show();
            }
        }
    });
}

function removeApplication(offer_id, worker_id, candidate_string){
    let success_msg = new Map();
    success_msg.set('it','La candidatura e\' stata rimossa con successo');
    success_msg.set('en','You are no longer applied for this position');
    candidate_string = new Map();
    candidate_string.set('it','Candidati');
    candidate_string.set('en','Apply');
    let lang = $('body').attr('lang');

    $.ajax({
        url: '/application/uncandidate',
        type: 'GET',
        data: {
            offer: offer_id,
            worker: worker_id
        },
        success: function(data){
            if(data.done){
                $('#msg_success_text').html(success_msg.get(lang));
                $('#msg_success').show();
                $('#candidate_btn').unbind('click');
                $('#candidate_btn').click(function(){
                    candidate(offer_id,worker_id);
                });
                $('#candidate_btn').html(candidate_string.get(lang));
            }
        }
    });
}

const paginate = (parent, itemsPerPage = 5, maxButtons = 3, initialPage = 0) => {
    const paginationNav = document.querySelector("#pagination-nav");
    if (!paginationNav) {
        throw new Error("No pagination nav found");
    }
    function formatPage(page) {
        paginationNav.innerHTML = "";
        const items = Array.from(parent.children);
        const pages = Math.ceil(items.length / itemsPerPage);
        page = Math.max(0, Math.min(page, pages - 1));
        parent.dataset.currentPage = page;
        const startItem = page * itemsPerPage;
        const endItem = Math.min(startItem + itemsPerPage, items.length);
        items.forEach((child, i) => {
            child.hidden = !(i >= startItem && i < endItem);
        });
        if (items.length > itemsPerPage) {
            const paginationList = createPaginationList(pages, page);
            paginationNav.appendChild(paginationList);
        }
    };
    function createPaginationList(pages, currentPage) {
        const createButton = (text) => {
            return tag("li", { class: "page-item" }, [
                tag("button", { class: "page-link" }, [text]),
            ]);
        };
        const list = tag("ul", { class: "pagination" });
        const prev = createButton("<");
        prev.addEventListener("click", (event) => {
            event.preventDefault();
            if (currentPage > 0) {
                currentPage--;
                formatPage(currentPage);
            }
        });
        list.appendChild(prev);
        for (let i = 0; i < pages; i++) {
            const li = createButton(i + 1);
            li.addEventListener("click", (event) => {
                event.preventDefault();
                formatPage(i);
            });
            list.appendChild(li);
        }
        const succ = createButton(">");
        succ.addEventListener("click", (event) => {
            event.preventDefault();
            if (currentPage < pages - 1) {
                currentPage++;
                formatPage(currentPage);
            }
        });
        list.appendChild(succ);
        const buttons = Array.from(list.children);
        buttons.pop();
        buttons.shift();
        buttons.forEach((li, i) => {
            if (i === currentPage) {
                li.classList.add("active");
            } else {
                li.classList.remove("active");
            }
        });
        const startButton = Math.max(0, currentPage - Math.floor(maxButtons / 2));
        const endButton = Math.min(currentPage + Math.floor(maxButtons / 2), buttons.length - 1);
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].hidden = !(i >= startButton && i <= endButton);
        }
        return list;
    };
    formatPage(initialPage);

    const obs = new MutationObserver(() => {
        formatPage(parent.dataset.currentPage || 0);
    });
    obs.observe(parent, {
        childList: true,
    });
};

const tag = (tagname, props = {}, children = []) => {
    const element = document.createElement(tagname);
    for (let prop in props) {
        if (!props.hasOwnProperty(prop))
            continue;
        const val = props[prop];
        if (prop.startsWith('on') && prop in window) {
            element.addEventListener(prop.substr(2), val);
            continue;
        }
        element.setAttribute(prop, val.toString())
    }   
    children.forEach((child) => {
        element.appendChild(child.nodeType === undefined ? 
            document.createTextNode(child.toString()) :
            child);
    }); 
    return element;
};

function confirm_offer_deletion(){
    $.confirm({
        title: 'Attention!',
        content: 'You are deleting this offer. Are you sure?',
        buttons: {
            somethingElse: {
                text: 'Confirm',
                btnClass: 'btn-red',
                action: function(){
                    window.location.href = document.getElementById('delete_offer').href;
                }
            },
            cancel: function () {},
            
        },
        
    });
}