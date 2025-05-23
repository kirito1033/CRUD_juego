const formId = 'my-form';
const modalId = 'my-modal';
const model = 'warrior';
const tableId = 'table-index';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);

/* These lines of code are declaring and initializing variables in a JavaScript file.
   Here is a breakdown of what each variable is used for: */
var insertUpdate = true;
var url = "";
var method = "";
var url = "";
var data = "";
var resultfetch = null;


function show(id) {
    mainApp.disabledFormAll();
    mainApp.resetForm();
    btnEnabled(true);
    getDataId(id);
}
function add() {
    mainApp.enableFormAll();
    mainApp.resetForm();
    insertUpdate = true;
    btnEnabled(false);
    mainApp.showModal();
    console.log(data);
}
function edit(id) {
    mainApp.disabledFormEdit();
    mainApp.resetForm();
    insertUpdate = false;
    btnEnabled(false);
    getDataId(id);
}
async function delete_(id) {
     method = 'GET';
     url = URI_WARRIOR + LIST_CRUD[3] + '/' + id;
     data = "";
    if (confirm(textConfirm) == true) {
        resultFetch = getData(data, method, url);
        resultFetch.then(response => response.json())
            .then(data => {
                //
                // Reload View 
                reloadPage();
            })
            .catch(error => {
                console.error(error);
                // Hidden Preload 
                mainApp.hiddenPreload();
            })
            .finally();
    } else {
        // Do nothing if not confirmed
    }
    mainApp.hiddenPreload();
}

async function getDataId(id) {
     method = 'GET';
     url = URI_WARRIOR + LIST_CRUD[1] + '/' + id;
     data = mainApp.getDataFormJson();
     resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
        .then(data => {
            console.log(data);
            // Set data form
            mainApp.setDataFormJson(data[model]);
            // Show Modal
            mainApp.showModal();
            // Hidden Preload
            mainApp.hiddenPreload();
        })
        .catch(error => {
            console.error(error);
            // Hidden Preload
            mainApp.hiddenPreload();
        })
        .finally();
}


function btnEnabled(type) {
    btnSubmit.disabled = type;
}

async function getData(data, method, url) {
    var parameters;
    // Show Preload
    mainApp.showPreload();
    if (method === "GET") {
        parameters = {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }
    } else {
        parameters = {
            method: method,
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }
    }
    return await fetch(url, parameters);
}

$(document).ready(function () {
    $('#' + tableId).DataTable();
});

mainApp.getForm().addEventListener("submit", async function(event) {
    event.preventDefault();

    if (mainApp.setValidateForm()) {
        // Show Preload
        mainApp.showPreload();

        if (insertUpdate) {
            // Insertion branch
             method = "POST";
             url = URI_WARRIOR + LIST_CRUD[0]; // Replace 0 with the appropriate index for insertion if needed
             data = mainApp.getDataFormJson();
             resultFetch = getData(data, method, url);

            resultFetch.then(response => response.json())
                .then(data => {
                
                    mainApp.hiddenModal();
                    reloadPage();
                })
                .catch(error => {
                    console.error(error);
                    mainApp.hiddenPreload();
                })
                .finally();
        } else {
            // Update branch
             method = "POST";
             url = URI_WARRIOR + LIST_CRUD[2]; // Update endpoint
             data = mainApp.getDataFormJson();
             resultFetch = getData(data, method, url);

            resultFetch.then(response => response.json())
                .then(data => {
                    console.log(data)
                    mainApp.hiddenModal();
                    reloadPage();
                })
                .catch(error => {
                    console.error(error);
                    mainApp.hiddenPreload();
                })
                .finally();

            
        }
    } else {
        alert("Data Validate");
        mainApp.resetForm();
    }
});

function reloadPage() {
    setTimeout(function () {
        // Hidden Preload
        mainApp.hiddenPreload();
        //location.reload();
    }, 500);
}

